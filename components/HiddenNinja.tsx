"use client";

import { useState, useCallback, useEffect } from "react";
import { useEasterEggContext } from "@/contexts/EasterEggContext";

export default function HiddenNinja() {
  const [ninjaTop, setNinjaTop] = useState(50);
  const { discoverEasterEgg } = useEasterEggContext();

  // Position aléatoire du ninja au chargement
  useEffect(() => {
    const randomTop = Math.random() * 60 + 20; // Entre 20% et 80% de la hauteur
    setNinjaTop(randomTop);
  }, []);

  const handleNinjaClick = useCallback(() => {
    discoverEasterEgg("ninja-stealth");

    document.body.style.filter = "grayscale(100%)";

    // Repositionner le ninja aléatoirement
    const newRandomTop = Math.random() * 60 + 20; // Entre 20% et 80% de la hauteur
    setNinjaTop(newRandomTop);

    // Désactiver après 5 secondes
    setTimeout(() => {
      document.body.style.filter = "";
    }, 5000);
  }, [discoverEasterEgg]);

  return (
    <div
      className="absolute -right-4 cursor-pointer hover:-translate-x-2 transition-transform duration-300 z-50 select-none"
      onClick={handleNinjaClick}
      title="🥷"
      style={{
        top: `${ninjaTop}%`,
        transform: "rotate(-30deg)",
        fontSize: "32px",
        textShadow: "2px 2px 4px rgba(0,0,0,0.3)",
      }}
    >
      🥷
    </div>
  );
}
