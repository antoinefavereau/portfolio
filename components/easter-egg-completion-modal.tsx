"use client";

import React from "react";
import { Modal } from "@/components/ui/modal";
import Button from "./ui/button";
import { Confetti } from "./confetti";

interface EasterEggCompletionModalProps {
  isOpen: boolean;
  onClose: () => void;
  completionTexts: {
    title: string;
    message: string;
    subtitle: string;
    close: string;
  };
}

export function EasterEggCompletionModal({
  isOpen,
  onClose,
  completionTexts,
}: EasterEggCompletionModalProps) {
  return (
    <>
      <Confetti active={isOpen} duration={4000} particleCount={80} />
      <Modal isOpen={isOpen} onClose={onClose} title={completionTexts.title}>
        <div className="space-y-4">
          <p className="text-lg text-light">{completionTexts.message}</p>
          <p className="text-sm dark:text-light">{completionTexts.subtitle}</p>
          <div className="flex justify-center pt-4">
            <Button onClick={onClose}>{completionTexts.close}</Button>
          </div>
        </div>
      </Modal>
    </>
  );
}
