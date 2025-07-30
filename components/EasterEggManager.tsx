"use client";

import { useAutoEasterEggs } from "@/hooks/useEasterEgg";
import { useEasterEggContext } from "@/contexts/EasterEggContext";
import { useState } from "react";

export default function EasterEggManager() {
  // Initialiser les easter eggs automatiques
  useAutoEasterEggs();

  const { getDiscoveryCount, totalEggs, discoveredEggs } =
    useEasterEggContext();
  const [isOpen, setIsOpen] = useState(false);
  const count = getDiscoveryCount();

  if (count === 0) return null;

  return (
    <div className="fixed bottom-4 left-4 z-[9998]">
      {/* Compteur d'easter eggs */}
      <button
        onClick={() => setIsOpen(!isOpen)}
        className="relative bg-primary hover:bg-primary-dark text-background rounded-full p-3 shadow-lg transition-all duration-300 transform hover:scale-105"
      >
        <div className="flex items-center space-x-2">
          <span className="text-2xl">🥚</span>
          <span className="font-bold text-sm">
            {count}/{totalEggs}
          </span>
        </div>
      </button>

      {/* Panel des découvertes */}
      {isOpen && (
        <div className="absolute bottom-full left-0 mb-2 bg-background rounded-lg shadow-xl border border-light p-4 min-w-[300px] max-w-[400px]">
          <div className="flex items-center justify-between mb-3">
            <h3 className="font-bold text-foreground">
              Easter Eggs Découverts
            </h3>
            <button
              onClick={() => setIsOpen(false)}
              className="text-dark hover:text-foreground text-xl"
            >
              ×
            </button>
          </div>

          <div className="space-y-2 max-h-60 overflow-y-auto">
            {discoveredEggs.length === 0 ? (
              <p className="text-dark text-sm">Aucun easter egg découvert</p>
            ) : (
              discoveredEggs.map((egg) => (
                <div
                  key={egg.id}
                  className="flex items-center space-x-3 p-2 rounded-md"
                >
                  <span className="text-lg">🎉</span>
                  <div className="flex-1">
                    <p className="font-semibold text-sm text-foreground">
                      {egg.name}
                    </p>
                    <p className="text-xs text-dark">{egg.description}</p>
                    {egg.discoveredAt && (
                      <p className="text-xs text-dark">
                        {new Date(egg.discoveredAt).toLocaleTimeString()}
                      </p>
                    )}
                  </div>
                </div>
              ))
            )}
          </div>

          {count === totalEggs && (
            <div className="mt-3 p-3 bg-gradient-to-r from-yellow-100 to-yellow-200 rounded-md border border-yellow-300">
              <p className="text-sm font-bold text-yellow-800 text-center">
                🏆 Félicitations ! Vous avez trouvé tous les easter eggs ! 🏆
              </p>
            </div>
          )}
        </div>
      )}
    </div>
  );
}
