"use client";

import {
  createContext,
  useContext,
  useState,
  useEffect,
  ReactNode,
} from "react";

interface MatrixModeContextType {
  isMatrixMode: boolean;
  toggleMatrixMode: () => void;
  enterMatrixMode: () => void;
  exitMatrixMode: () => void;
}

const MatrixModeContext = createContext<MatrixModeContextType | undefined>(
  undefined
);

export const useMatrixMode = () => {
  const context = useContext(MatrixModeContext);
  if (!context) {
    throw new Error("useMatrixMode must be used within a MatrixModeProvider");
  }
  return context;
};

interface MatrixModeProviderProps {
  children: ReactNode;
}

export const MatrixModeProvider = ({ children }: MatrixModeProviderProps) => {
  const [isMatrixMode, setIsMatrixMode] = useState(false);

  const enterMatrixMode = () => {
    setIsMatrixMode(true);
    document.body.classList.add("matrix-mode");

    // Créer l'effet de pluie Matrix
    createMatrixRain();
  };

  const exitMatrixMode = () => {
    setIsMatrixMode(false);
    document.body.classList.remove("matrix-mode");

    // Supprimer l'effet de pluie
    const matrixRain = document.querySelector(".matrix-rain");
    if (matrixRain) {
      matrixRain.remove();
    }
  };

  const toggleMatrixMode = () => {
    if (isMatrixMode) {
      exitMatrixMode();
    } else {
      enterMatrixMode();
    }
  };

  const createMatrixRain = () => {
    // Supprimer l'ancien rain s'il existe
    const existingRain = document.querySelector(".matrix-rain");
    if (existingRain) {
      existingRain.remove();
    }

    const rain = document.createElement("div");
    rain.className = "matrix-rain";
    document.body.appendChild(rain);

    const characters =
      "01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン";
    const columns = Math.floor(window.innerWidth / 20);

    for (let i = 0; i < columns; i++) {
      createMatrixColumn(rain, characters, i);
    }
  };

  const createMatrixColumn = (
    container: HTMLElement,
    characters: string,
    columnIndex: number
  ) => {
    const createChar = () => {
      const char = document.createElement("div");
      char.className = "matrix-char";
      char.textContent =
        characters[Math.floor(Math.random() * characters.length)];
      char.style.left = `${columnIndex * 20}px`;
      char.style.animationDelay = `${Math.random() * 3}s`;
      char.style.animationDuration = `${3 + Math.random() * 2}s`;

      container.appendChild(char);

      // Supprimer le caractère après l'animation
      setTimeout(() => {
        if (char.parentNode) {
          char.parentNode.removeChild(char);
        }
      }, 5000);
    };

    // Créer des caractères de façon continue
    const interval = setInterval(() => {
      if (document.body.classList.contains("matrix-mode")) {
        createChar();
      } else {
        clearInterval(interval);
      }
    }, Math.random() * 500 + 200);
  };

  // Nettoyer lors du démontage
  useEffect(() => {
    return () => {
      exitMatrixMode();
    };
  }, []);

  const value = {
    isMatrixMode,
    toggleMatrixMode,
    enterMatrixMode,
    exitMatrixMode,
  };

  return (
    <MatrixModeContext.Provider value={value}>
      {children}
      {isMatrixMode && (
        <button
          className="matrix-exit-button"
          onClick={exitMatrixMode}
          title="Quitter le mode Matrix"
        >
          Sortir de Matrix
        </button>
      )}
    </MatrixModeContext.Provider>
  );
};
