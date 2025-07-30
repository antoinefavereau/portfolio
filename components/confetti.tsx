"use client";

import React, { useEffect, useState } from "react";

interface ConfettiPiece {
  id: number;
  x: number;
  y: number;
  rotation: number;
  color: string;
  size: number;
  velocityX: number;
  velocityY: number;
  rotationSpeed: number;
}

interface ConfettiProps {
  active: boolean;
  duration?: number;
  particleCount?: number;
}

const CONFETTI_COLORS = [
  "#ff6b6b",
  "#4ecdc4",
  "#45b7d1",
  "#96ceb4",
  "#feca57",
  "#ff9ff3",
  "#f368e0",
  "#fd79a8",
  "#a29bfe",
  "#6c5ce7",
];

export function Confetti({
  active,
  duration = 3000,
  particleCount = 50,
}: ConfettiProps) {
  const [pieces, setPieces] = useState<ConfettiPiece[]>([]);

  useEffect(() => {
    if (!active) {
      setPieces([]);
      return;
    }

    // Créer les confettis initiaux
    const initialPieces: ConfettiPiece[] = Array.from(
      { length: particleCount },
      (_, i) => ({
        id: i,
        x: Math.random() * window.innerWidth,
        y: -10,
        rotation: Math.random() * 360,
        color:
          CONFETTI_COLORS[Math.floor(Math.random() * CONFETTI_COLORS.length)],
        size: Math.random() * 8 + 4,
        velocityX: (Math.random() - 0.5) * 4,
        velocityY: Math.random() * 3 + 2,
        rotationSpeed: (Math.random() - 0.5) * 10,
      })
    );

    setPieces(initialPieces);

    // Animation des confettis
    const animationInterval = setInterval(() => {
      setPieces((prevPieces) =>
        prevPieces
          .map((piece) => ({
            ...piece,
            x: piece.x + piece.velocityX,
            y: piece.y + piece.velocityY,
            rotation: piece.rotation + piece.rotationSpeed,
            velocityY: piece.velocityY + 0.1, // Gravité
          }))
          .filter((piece) => piece.y < window.innerHeight + 50)
      );
    }, 16); // ~60fps

    // Nettoyer après la durée spécifiée
    const cleanupTimeout = setTimeout(() => {
      clearInterval(animationInterval);
      setPieces([]);
    }, duration);

    return () => {
      clearInterval(animationInterval);
      clearTimeout(cleanupTimeout);
    };
  }, [active, duration, particleCount]);

  if (!active || pieces.length === 0) return null;

  return (
    <div className="fixed inset-0 pointer-events-none z-60">
      {pieces.map((piece) => (
        <div
          key={piece.id}
          className="absolute"
          style={{
            left: piece.x,
            top: piece.y,
            width: piece.size,
            height: piece.size,
            backgroundColor: piece.color,
            borderRadius: "2px",
            transform: `rotate(${piece.rotation}deg)`,
            transition: "none",
          }}
        />
      ))}
    </div>
  );
}
