"use client";

import { useEffect } from "react";
import { SUPPORTED_LOCALES, type SupportedLocale } from "@/lib/constants";

interface LangSetterProps {
  locale: string;
}

export default function LangSetter({ locale }: LangSetterProps) {
  useEffect(() => {
    // Validation côté client avec les constantes partagées
    if (SUPPORTED_LOCALES.includes(locale as SupportedLocale)) {
      document.documentElement.lang = locale;
    }
  }, [locale]);

  return null; // Ce composant ne rend rien
}
