"use client";

import React, { useState, useEffect } from "react";

interface Toast {
  id: string;
  message: string;
  title?: string;
  type: "success" | "info" | "warning" | "error";
  duration?: number;
}

interface ToastContextType {
  showToast: (
    message: string,
    type?: Toast["type"],
    duration?: number,
    title?: string
  ) => void;
}

const ToastContext = React.createContext<ToastContextType | undefined>(
  undefined
);

export function ToastProvider({ children }: { children: React.ReactNode }) {
  const [toasts, setToasts] = useState<Toast[]>([]);

  const showToast = (
    message: string,
    type: Toast["type"] = "success",
    duration = 10000,
    title?: string
  ) => {
    const id = Math.random().toString(36).substr(2, 9);
    const newToast: Toast = { id, message, type, duration, title };

    setToasts((prev) => [...prev, newToast]);

    // Supprimer automatiquement le toast après la durée spécifiée
    setTimeout(() => {
      setToasts((prev) => prev.filter((toast) => toast.id !== id));
    }, duration);
  };

  const removeToast = (id: string) => {
    setToasts((prev) => prev.filter((toast) => toast.id !== id));
  };

  return (
    <ToastContext.Provider value={{ showToast }}>
      {children}
      <ToastContainer toasts={toasts} onRemove={removeToast} />
    </ToastContext.Provider>
  );
}

function ToastContainer({
  toasts,
  onRemove,
}: {
  toasts: Toast[];
  onRemove: (id: string) => void;
}) {
  return (
    <div className="fixed top-4 right-4 z-[9999] space-y-2">
      {toasts.map((toast) => (
        <ToastItem key={toast.id} toast={toast} onRemove={onRemove} />
      ))}
    </div>
  );
}

function ToastItem({
  toast,
  onRemove,
}: {
  toast: Toast;
  onRemove: (id: string) => void;
}) {
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    // Animation d'entrée
    const timer = setTimeout(() => setIsVisible(true), 10);
    return () => clearTimeout(timer);
  }, []);

  const handleClose = () => {
    setIsVisible(false);
    setTimeout(() => onRemove(toast.id), 300);
  };

  const getTypeStyles = () => {
    switch (toast.type) {
      case "success":
        return "bg-green-500 border-green-600";
      case "error":
        return "bg-red-500 border-red-600";
      case "warning":
        return "bg-yellow-500 border-yellow-600";
      case "info":
      default:
        return "bg-primary border-primary-dark";
    }
  };

  const getIcon = () => {
    switch (toast.type) {
      case "success":
        return "🎉";
      case "error":
        return "❌";
      case "warning":
        return "⚠️";
      case "info":
      default:
        return "🔍";
    }
  };

  return (
    <div
      className={`
        transform transition-all duration-300 ease-in-out
        ${
          isVisible ? "translate-x-0 opacity-100" : "translate-x-full opacity-0"
        }
        ${getTypeStyles()}
        text-background px-4 py-3 rounded-lg shadow-lg border-l-4 min-w-[300px] max-w-[400px]
      `}
    >
      <div className="flex items-center justify-between">
        <div className="flex items-center space-x-3">
          <span className="text-xl">{getIcon()}</span>
          <div>
            <p className="font-semibold text-sm">
              {toast.title || "Easter Egg Découvert!"}
            </p>
            <p className="text-xs opacity-90">{toast.message}</p>
          </div>
        </div>
        <button
          onClick={handleClose}
          className="ml-4 text-foreground hover:text-light transition-colors text-lg font-bold"
        >
          ×
        </button>
      </div>
    </div>
  );
}

export function useToast() {
  const context = React.useContext(ToastContext);
  if (context === undefined) {
    throw new Error("useToast must be used within a ToastProvider");
  }
  return context;
}
