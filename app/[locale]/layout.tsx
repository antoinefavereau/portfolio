import type { Metadata } from "next";
import "../globals.css";
import LenisProvider from "@/components/LenisProvider";
import CustomCursor from "@/components/custom-cursor";
import { EasterEggProvider } from "@/contexts/EasterEggContext";
import { ToastProvider } from "@/components/ToastProvider";
import EasterEggManager from "@/components/EasterEggManager";
import { MatrixModeProvider } from "@/contexts/MatrixModeContext";
import HiddenNinja from "@/components/HiddenNinja";
import StructuredData from "@/components/structured-data";
import LangSetter from "@/components/lang-setter";
import { notFound } from "next/navigation";
import {
  SUPPORTED_LOCALES,
  BASE_URL,
  type SupportedLocale,
} from "@/lib/constants";

export async function generateMetadata({
  params,
}: {
  params: Promise<{ locale: string }>;
}): Promise<Metadata> {
  const { locale } = await params;

  // Validation de la locale
  if (!SUPPORTED_LOCALES.includes(locale as SupportedLocale)) {
    notFound();
  }

  const baseUrl = BASE_URL;
  const isEnglish = locale === "en";

  return {
    title: isEnglish
      ? "Antoine Favereau - Full Stack Developer & Web Engineer"
      : "Antoine Favereau - Développeur Full Stack & Ingénieur Web",
    description: isEnglish
      ? "Full Stack Developer based in Paris, France, specializing in React, Next.js, Node.js. Creating modern web applications with cutting-edge technologies. Available for freelance projects."
      : "Développeur Full Stack basé à Paris, spécialisé en React, Next.js, Node.js. Création d'applications web modernes avec des technologies de pointe. Disponible pour projets freelance.",
    keywords: isEnglish
      ? [
          "Antoine Favereau",
          "Full Stack Developer",
          "React",
          "Next.js",
          "Node.js",
          "JavaScript",
          "TypeScript",
          "Web Development",
          "Frontend",
          "Backend",
        ]
      : [
          "Antoine Favereau",
          "Développeur Full Stack",
          "React",
          "Next.js",
          "Node.js",
          "JavaScript",
          "TypeScript",
          "Développement Web",
          "Frontend",
          "Backend",
        ],
    authors: [{ name: "Antoine Favereau" }],
    creator: "Antoine Favereau",
    publisher: "Antoine Favereau",
    alternates: {
      canonical: `${baseUrl}/${locale}`,
      languages: {
        fr: `${baseUrl}/fr`,
        en: `${baseUrl}/en`,
      },
    },
    openGraph: {
      type: "website",
      locale: locale,
      url: `${baseUrl}/${locale}`,
      title: isEnglish
        ? "Antoine Favereau - Full Stack Developer & Web Engineer"
        : "Antoine Favereau - Développeur Full Stack & Ingénieur Web",
      description: isEnglish
        ? "Full Stack Developer based in Paris, France, specializing in React, Next.js, Node.js. Creating modern web applications with cutting-edge technologies."
        : "Développeur Full Stack basé à Paris, spécialisé en React, Next.js, Node.js. Création d'applications web modernes avec des technologies de pointe.",
      siteName: "Antoine Favereau Portfolio",
    },
    twitter: {
      card: "summary_large_image",
      title: isEnglish
        ? "Antoine Favereau - Full Stack Developer"
        : "Antoine Favereau - Développeur Full Stack",
      description: isEnglish
        ? "Full Stack Developer based in Paris specializing in modern web technologies"
        : "Développeur Full Stack basé à Paris spécialisé en technologies web modernes",
    },
    robots: {
      index: true,
      follow: true,
      googleBot: {
        index: true,
        follow: true,
        "max-video-preview": -1,
        "max-image-preview": "large",
        "max-snippet": -1,
      },
    },
  };
}

export function generateStaticParams() {
  return SUPPORTED_LOCALES.map((locale) => ({ locale }));
}

export default async function LocaleLayout({
  children,
  params,
}: Readonly<{
  children: React.ReactNode;
  params: Promise<{ locale: string }>;
}>) {
  const { locale } = await params;

  // Validation de la locale
  if (!SUPPORTED_LOCALES.includes(locale as SupportedLocale)) {
    notFound();
  }

  // Import sécurisé avec gestion d'erreur
  let texts;
  try {
    const textsModule = await import(`@/data/${locale}/texts.json`);
    texts = textsModule.default;
  } catch (error) {
    console.error(`Failed to load texts for locale: ${locale}`, error);
    notFound();
  }

  return (
    <>
      <LangSetter locale={locale} />
      <StructuredData locale={locale} />
      <ToastProvider>
        <EasterEggProvider
          easterEggTexts={texts.easter_eggs}
          completionTexts={texts.easter_eggs_completion}
          easterEggMessages={texts.easter_eggs_messages}
        >
          <MatrixModeProvider>
            <div className="max-md:hidden">
              <CustomCursor />
            </div>
            <LenisProvider>
              {children}
              <HiddenNinja />
            </LenisProvider>
            <EasterEggManager />
          </MatrixModeProvider>
        </EasterEggProvider>
      </ToastProvider>
    </>
  );
}
