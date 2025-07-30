"use client";

import { useEffect, useState, useCallback, useRef } from "react";

export default function CustomCursor() {
  const [mousePosition, setMousePosition] = useState({ x: 0, y: 0 });
  const [cursorPosition, setCursorPosition] = useState({ x: 0, y: 0 });
  const [isHovering, setIsHovering] = useState(false);
  const [isVisible, setIsVisible] = useState(false);
  const [iconElement, setIconElement] = useState<HTMLElement | null>(null);
  const animationRef = useRef<number>(0);

  const updateMousePosition = useCallback((e: MouseEvent) => {
    setMousePosition({ x: e.clientX, y: e.clientY });
  }, []);

  const handleMouseEnter = useCallback(() => setIsHovering(true), []);
  const handleMouseLeave = useCallback(() => setIsHovering(false), []);

  const handleIconMouseEnter = useCallback((e: Event) => {
    const target = e.currentTarget as HTMLElement;
    setIconElement(target);
    setIsHovering(true);
  }, []);

  const handleIconMouseLeave = useCallback(() => {
    setIconElement(null);
    setIsHovering(false);
  }, []);

  const handleMouseEnterScreen = useCallback(() => setIsVisible(true), []);
  const handleMouseLeaveScreen = useCallback(() => setIsVisible(false), []);

  // Animation avec effet de lag
  useEffect(() => {
    const animateCursor = () => {
      setCursorPosition((prev) => {
        let targetX = mousePosition.x;
        let targetY = mousePosition.y;

        // Si on survole un élément avec la classe "icon", cibler le centre de cet élément
        if (iconElement) {
          const rect = iconElement.getBoundingClientRect();
          targetX = rect.left + rect.width / 2;
          targetY = rect.top + rect.height / 2;
        }

        // Appliquer le lag pour une transition fluide
        const diff = {
          x: targetX - prev.x,
          y: targetY - prev.y,
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
  }, [mousePosition, iconElement]);

  useEffect(() => {
    // Ajouter les event listeners pour le mouvement de la souris
    window.addEventListener("mousemove", updateMousePosition);

    // Event listeners pour détecter quand la souris entre/sort de l'écran
    document.addEventListener("mouseenter", handleMouseEnterScreen);
    document.addEventListener("mouseleave", handleMouseLeaveScreen);

    const setupInteractiveElements = () => {
      // Sélecteur pour tous les éléments interactifs
      const interactiveElements = document.querySelectorAll("a, button");
      const iconElements = document.querySelectorAll(".icon");

      interactiveElements.forEach((element) => {
        element.addEventListener("mouseenter", handleMouseEnter);
        element.addEventListener("mouseleave", handleMouseLeave);
      });

      // Gestionnaires spéciaux pour les éléments avec la classe "icon"
      iconElements.forEach((element) => {
        element.addEventListener("mouseenter", handleIconMouseEnter);
        element.addEventListener("mouseleave", handleIconMouseLeave);
      });

      return { interactiveElements, iconElements };
    };

    // Configuration initiale
    const elements = setupInteractiveElements();

    // Observer pour détecter les nouveaux éléments ajoutés au DOM
    const observer = new MutationObserver(() => {
      // Nettoyer les anciens listeners
      elements.interactiveElements.forEach((element) => {
        element.removeEventListener("mouseenter", handleMouseEnter);
        element.removeEventListener("mouseleave", handleMouseLeave);
      });
      elements.iconElements.forEach((element) => {
        element.removeEventListener("mouseenter", handleIconMouseEnter);
        element.removeEventListener("mouseleave", handleIconMouseLeave);
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
      elements.interactiveElements.forEach((element) => {
        element.removeEventListener("mouseenter", handleMouseEnter);
        element.removeEventListener("mouseleave", handleMouseLeave);
      });
      elements.iconElements.forEach((element) => {
        element.removeEventListener("mouseenter", handleIconMouseEnter);
        element.removeEventListener("mouseleave", handleIconMouseLeave);
      });
      observer.disconnect();
    };
  }, [
    updateMousePosition,
    handleMouseEnter,
    handleMouseLeave,
    handleIconMouseEnter,
    handleIconMouseLeave,
    handleMouseEnterScreen,
    handleMouseLeaveScreen,
  ]);

  return (
    <div
      className="custom-cursor"
      style={{
        left: cursorPosition.x,
        top: cursorPosition.y,
        transform: (() => {
          if (iconElement) {
            // Récupérer les dimensions de l'élément icon
            const rect = iconElement.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            // Ajuster la taille du curseur à 140% de la taille de l'élément
            const scale = (size * 1.4) / 20; // 20px est la taille de base du curseur, 1.4 = 140%
            return `translate(-50%, -50%) scale(${scale})`;
          }
          return `translate(-50%, -50%) scale(${isHovering ? 2 : 1})`;
        })(),
        opacity: isVisible ? 1 : 0,
      }}
    />
  );
}
