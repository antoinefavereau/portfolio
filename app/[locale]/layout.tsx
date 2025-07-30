import type { Metadata } from "next";
import "../globals.css";
import LenisProvider from "@/components/LenisProvider";
import CustomCursor from "@/components/custom-cursor";
import { EasterEggProvider } from "@/contexts/EasterEggContext";
import { ToastProvider } from "@/components/ToastProvider";
import EasterEggManager from "@/components/EasterEggManager";
import { MatrixModeProvider } from "@/contexts/MatrixModeContext";
import HiddenNinja from "@/components/HiddenNinja";

export const metadata: Metadata = {
  title: "Portfolio Antoine Favereau",
  description: "Portfolio Antoine Favereau",
};

export function generateStaticParams() {
  return ["en", "fr"].map((locale) => ({ locale }));
}

export default async function RootLayout({
  children,
  params,
}: Readonly<{
  children: React.ReactNode;
  params: Promise<{ locale: string }>;
}>) {
  const { locale } = await params;
  const { default: texts } = await import(`@/data/${locale}/texts.json`);

  return (
    <html lang={locale} data-scroll-behavior="smooth">
      <body className="antialiased relative overflow-x-hidden">
        <ToastProvider>
          <EasterEggProvider
            easterEggTexts={texts.easter_eggs}
            completionTexts={texts.easter_eggs_completion}
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
      </body>
    </html>
  );
}
