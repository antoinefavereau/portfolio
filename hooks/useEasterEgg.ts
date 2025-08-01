import { useCallback, useRef, useEffect } from "react";
import { useEasterEggContext } from "@/contexts/EasterEggContext";
import { useMatrixMode } from "@/contexts/MatrixModeContext";

type EasterEggId =
  | "logo-spin"
  | "name-spin"
  | "skill-master"
  | "footer-surprise"
  | "konami-code"
  | "scroll-detective"
  | "ninja-stealth"
  | "secret-message"
  | "screensaver";

interface EasterEggOptions {
  clickThreshold?: number;
  resetDelay?: number;
}

// Hook principal pour les easter eggs par clic
export const useEasterEgg = (
  eggId: EasterEggId,
  options: EasterEggOptions = {}
) => {
  const { clickThreshold = 5, resetDelay = 2000 } = options;
  const clickCountRef = useRef(0);
  const timeoutRef = useRef<NodeJS.Timeout | null>(null);
  const elementRef = useRef<HTMLElement | null>(null);

  const { discoverEasterEgg } = useEasterEggContext();

  const handleClick = useCallback(
    (event: React.MouseEvent<HTMLElement>) => {
      const target = event.currentTarget;

      if (elementRef.current && elementRef.current !== target) {
        clickCountRef.current = 0;
      }

      elementRef.current = target;
      clickCountRef.current += 1;

      if (timeoutRef.current) {
        clearTimeout(timeoutRef.current);
      }

      if (clickCountRef.current >= clickThreshold) {
        event.preventDefault();
        event.stopPropagation();

        // Remettre immédiatement le compteur à zéro pour éviter les doubles déclenchements
        clickCountRef.current = 0;

        if (eggId === "logo-spin") {
          document.body.classList.add("site-spin");
          setTimeout(() => {
            document.body.classList.remove("site-spin");
            discoverEasterEgg(eggId);
          }, 4000);
        } else {
          // Comportement par défaut
          target.classList.add("easter-egg-spin");
          discoverEasterEgg(eggId);
          setTimeout(() => {
            target.classList.remove("easter-egg-spin");
          }, 2000);
        }
      } else {
        timeoutRef.current = setTimeout(() => {
          clickCountRef.current = 0;
        }, resetDelay);
      }
    },
    [clickThreshold, resetDelay, eggId, discoverEasterEgg]
  );

  return handleClick;
};

// Hook pour easter eggs automatiques (Konami, scroll)
export const useAutoEasterEggs = () => {
  const { discoverEasterEgg } = useEasterEggContext();
  const { enterMatrixMode } = useMatrixMode();

  // Code Konami
  useEffect(() => {
    let sequence: string[] = [];
    // Support pour claviers QWERTY et AZERTY
    const konamiCode = [
      "ArrowUp",
      "ArrowUp",
      "ArrowDown",
      "ArrowDown",
      "ArrowLeft",
      "ArrowRight",
      "ArrowLeft",
      "ArrowRight",
      "KeyB",
      "KeyA",
    ];
    const konamiCodeAZERTY = [
      "ArrowUp",
      "ArrowUp",
      "ArrowDown",
      "ArrowDown",
      "ArrowLeft",
      "ArrowRight",
      "ArrowLeft",
      "ArrowRight",
      "KeyB",
      "KeyQ",
    ];
    let timeoutId: NodeJS.Timeout;

    const handleKeyDown = (event: KeyboardEvent) => {
      // Ajouter la touche à la séquence
      sequence.push(event.code);

      // Limiter la longueur de la séquence
      if (sequence.length > konamiCode.length) {
        sequence = sequence.slice(-konamiCode.length);
      }

      // Vérifier si on a le code complet
      if (sequence.length === konamiCode.length) {
        // Vérifier les deux layouts
        const isQWERTY = sequence.every(
          (key, index) => key === konamiCode[index]
        );
        const isAZERTY = sequence.every(
          (key, index) => key === konamiCodeAZERTY[index]
        );

        if (isQWERTY || isAZERTY) {
          discoverEasterEgg("konami-code");

          // Activer le mode Matrix (même si déjà découvert)
          enterMatrixMode();

          sequence = []; // Reset après succès
        }
      }

      // Reset de la séquence après 5 secondes d'inactivité
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => {
        sequence = [];
      }, 5000);
    };

    document.addEventListener("keydown", handleKeyDown);
    return () => {
      document.removeEventListener("keydown", handleKeyDown);
      clearTimeout(timeoutId);
    };
  }, [discoverEasterEgg, enterMatrixMode]);

  // Scroll detective - Il faut aller en bas puis remonter en haut
  useEffect(() => {
    let hasReachedBottom = false;
    let hasReturnedToTop = false;

    const handleScroll = () => {
      const scrollTop =
        window.pageYOffset || document.documentElement.scrollTop;
      const windowHeight = window.innerHeight;
      const documentHeight = document.documentElement.scrollHeight;

      // Vérifier si on est en bas de la page (avec une marge de 50px)
      const isAtBottom = scrollTop + windowHeight >= documentHeight - 50;

      // Vérifier si on est en haut de la page (avec une marge de 50px)
      const isAtTop = scrollTop <= 50;

      // Première étape : atteindre le bas
      if (isAtBottom && !hasReachedBottom) {
        hasReachedBottom = true;
      }

      // Deuxième étape : retourner en haut après avoir atteint le bas
      if (hasReachedBottom && isAtTop && !hasReturnedToTop) {
        hasReturnedToTop = true;
        discoverEasterEgg("scroll-detective");

        // Reset pour permettre de refaire l'easter egg
        hasReachedBottom = false;
        hasReturnedToTop = false;
      }
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, [discoverEasterEgg]);

  // Easter egg d'inactivité (screensaver)
  useEffect(() => {
    let inactivityTimer: NodeJS.Timeout;
    let isScreensaverActive = false;

    const stopScreensaver = () => {
      if (isScreensaverActive) {
        document.body.classList.remove("screensaver");
        isScreensaverActive = false;
        // Comptabiliser l'easter egg seulement quand on l'arrête
        discoverEasterEgg("screensaver");
      }
    };

    const startInactivityTimer = () => {
      clearTimeout(inactivityTimer);

      inactivityTimer = setTimeout(() => {
        if (!isScreensaverActive) {
          // Démarrer l'animation (infinite)
          document.body.classList.add("screensaver");
          isScreensaverActive = true;
        }
      }, 30000); // 30 secondes
    };

    const handleActivity = () => {
      stopScreensaver();
      startInactivityTimer();
    };

    const events = [
      "mousedown",
      "mousemove",
      "keypress",
      "scroll",
      "touchstart",
      "click",
    ];

    events.forEach((event) => {
      document.addEventListener(event, handleActivity, true);
    });

    startInactivityTimer(); // Démarrer le timer initial

    return () => {
      clearTimeout(inactivityTimer);
      events.forEach((event) => {
        document.removeEventListener(event, handleActivity, true);
      });
      if (isScreensaverActive) {
        document.body.classList.remove("screensaver");
      }
    };
  }, [discoverEasterEgg]);
};
