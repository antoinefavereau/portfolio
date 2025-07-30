"use client";

import React, { createContext, useContext, useState, useCallback } from "react";
import { useToast } from "@/components/ToastProvider";
import { EasterEggCompletionModal } from "@/components/easter-egg-completion-modal";

interface EasterEgg {
  id: string;
  name: string;
  description: string;
  discoveredAt?: Date;
}

interface EasterEggItem {
  name: string;
  description: string;
}

interface CompletionTexts {
  title: string;
  message: string;
  subtitle: string;
  close: string;
}

interface EasterEggTexts {
  [key: string]: EasterEggItem;
}

interface EasterEggContextType {
  discoveredEggs: EasterEgg[];
  totalEggs: number;
  discoverEasterEgg: (eggId: EasterEggId) => { isNew: boolean; count: number };
  isDiscovered: (eggId: EasterEggId) => boolean;
  getDiscoveryCount: () => number;
  showCompletionModal: boolean;
  closeCompletionModal: () => void;
}

const EasterEggContext = createContext<EasterEggContextType | undefined>(
  undefined
);

type EasterEggId = string;

export function EasterEggProvider({
  children,
  easterEggTexts,
  completionTexts,
}: {
  children: React.ReactNode;
  easterEggTexts: EasterEggTexts;
  completionTexts: CompletionTexts;
}) {
  const [discoveredEggs, setDiscoveredEggs] = useState<EasterEgg[]>([]);
  const [showCompletionModal, setShowCompletionModal] = useState(false);
  const { showToast } = useToast();

  const closeCompletionModal = useCallback(() => {
    setShowCompletionModal(false);
  }, []);

  const discoverEasterEgg = useCallback(
    (eggId: EasterEggId): { isNew: boolean; count: number } => {
      // Vérifier si l'easter egg n'a pas déjà été découvert
      const alreadyDiscovered = discoveredEggs.some((egg) => egg.id === eggId);

      if (!alreadyDiscovered) {
        const easterEgg = easterEggTexts[eggId];
        if (!easterEgg) return { isNew: false, count: discoveredEggs.length };

        const newEgg: EasterEgg = {
          id: eggId,
          name: easterEgg.name,
          description: easterEgg.description,
          discoveredAt: new Date(),
        };

        const newDiscoveredEggs = [...discoveredEggs, newEgg];
        setDiscoveredEggs(newDiscoveredEggs);

        // Afficher le toast automatiquement pour les nouveaux easter eggs
        showToast(
          easterEgg.description,
          "success",
          10000,
          `Easter Egg : ${easterEgg.name} (${newDiscoveredEggs.length}/${
            Object.keys(easterEggTexts).length
          })`
        );

        // Vérifier si tous les easter eggs sont découverts
        const totalEasterEggs = Object.keys(easterEggTexts).length;
        if (newDiscoveredEggs.length === totalEasterEggs) {
          // Délai pour laisser le temps au toast de s'afficher
          setTimeout(() => {
            setShowCompletionModal(true);
          }, 1000);
        }

        return { isNew: true, count: newDiscoveredEggs.length };
      }

      // Afficher un toast pour les easter eggs déjà découverts
      const easterEgg = easterEggTexts[eggId];
      if (easterEgg) {
        showToast(
          "Cet easter egg a déjà été découvert !",
          "info",
          5000,
          `Easter Egg : ${easterEgg.name}`
        );
      }
      return { isNew: false, count: discoveredEggs.length };
    },
    [discoveredEggs, showToast, easterEggTexts]
  );

  const isDiscovered = useCallback(
    (eggId: EasterEggId): boolean => {
      return discoveredEggs.some((egg) => egg.id === eggId);
    },
    [discoveredEggs]
  );

  const getDiscoveryCount = useCallback((): number => {
    return discoveredEggs.length;
  }, [discoveredEggs]);

  return (
    <EasterEggContext.Provider
      value={{
        discoveredEggs,
        totalEggs: Object.keys(easterEggTexts).length,
        discoverEasterEgg,
        isDiscovered,
        getDiscoveryCount,
        showCompletionModal,
        closeCompletionModal,
      }}
    >
      {children}
      <EasterEggCompletionModal
        isOpen={showCompletionModal}
        onClose={closeCompletionModal}
        completionTexts={completionTexts}
      />
    </EasterEggContext.Provider>
  );
}

export function useEasterEggContext() {
  const context = useContext(EasterEggContext);
  if (context === undefined) {
    throw new Error(
      "useEasterEggContext must be used within an EasterEggProvider"
    );
  }
  return context;
}
