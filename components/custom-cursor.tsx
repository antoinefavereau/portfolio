"use client";

import { useEffect, useState, useCallback, useRef } from "react";

export default function CustomCursor() {
  const [mousePosition, setMousePosition] = useState({ x: 0, y: 0 });
  const [cursorPosition, setCursorPosition] = useState({ x: 0, y: 0 });
  const [isHovering, setIsHovering] = useState(false);
  const [isVisible, setIsVisible] = useState(true);
  const animationRef = useRef<number>(0);

  const updateMousePosition = useCallback((e: MouseEvent) => {
    setMousePosition({ x: e.clientX, y: e.clientY });
  }, []);

  const handleMouseEnter = useCallback(() => setIsHovering(true), []);
  const handleMouseLeave = useCallback(() => setIsHovering(false), []);

  const handleMouseEnterScreen = useCallback(() => setIsVisible(true), []);
  const handleMouseLeaveScreen = useCallback(() => setIsVisible(false), []);

  // Animation avec effet de lag
  useEffect(() => {
    const animateCursor = () => {
      setCursorPosition((prev) => {
        const diff = {
          x: mousePosition.x - prev.x,
          y: mousePosition.y - prev.y,
        };

        // Facteur de lag (plus la valeur est petite, plus le lag est important)
        const lagFactor = 0.15;

        return {
          x: prev.x + diff.x * lagFactor,
          y: prev.y + diff.y * lagFactor,
        };
      });

      animationRef.current = requestAnimationFrame(animateCursor);
    };

    animationRef.current = requestAnimationFrame(animateCursor);

    return () => {
      if (animationRef.current) {
        cancelAnimationFrame(animationRef.current);
      }
    };
  }, [mousePosition]);

  useEffect(() => {
    // Ajouter les event listeners pour le mouvement de la souris
    window.addEventListener("mousemove", updateMousePosition);

    // Event listeners pour détecter quand la souris entre/sort de l'écran
    document.addEventListener("mouseenter", handleMouseEnterScreen);
    document.addEventListener("mouseleave", handleMouseLeaveScreen);

    const setupInteractiveElements = () => {
      // Sélecteur pour tous les éléments interactifs
      const interactiveElements = document.querySelectorAll("a, button");

      interactiveElements.forEach((element) => {
        element.addEventListener("mouseenter", handleMouseEnter);
        element.addEventListener("mouseleave", handleMouseLeave);
      });

      return interactiveElements;
    };

    // Configuration initiale
    const elements = setupInteractiveElements();

    // Observer pour détecter les nouveaux éléments ajoutés au DOM
    const observer = new MutationObserver(() => {
      // Nettoyer les anciens listeners
      elements.forEach((element) => {
        element.removeEventListener("mouseenter", handleMouseEnter);
        element.removeEventListener("mouseleave", handleMouseLeave);
      });
      // Reconfigurer avec les nouveaux éléments
      setupInteractiveElements();
    });

    // Observer les changements dans le DOM
    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });

    return () => {
      window.removeEventListener("mousemove", updateMousePosition);
      document.removeEventListener("mouseenter", handleMouseEnterScreen);
      document.removeEventListener("mouseleave", handleMouseLeaveScreen);
      elements.forEach((element) => {
        element.removeEventListener("mouseenter", handleMouseEnter);
        element.removeEventListener("mouseleave", handleMouseLeave);
      });
      observer.disconnect();
    };
  }, [
    updateMousePosition,
    handleMouseEnter,
    handleMouseLeave,
    handleMouseEnterScreen,
    handleMouseLeaveScreen,
  ]);

  return (
    <div
      className="custom-cursor"
      style={{
        left: cursorPosition.x,
        top: cursorPosition.y,
        transform: `translate(-50%, -50%) scale(${isHovering ? 3 : 1})`,
        opacity: isVisible ? 1 : 0,
      }}
    />
  );
}
