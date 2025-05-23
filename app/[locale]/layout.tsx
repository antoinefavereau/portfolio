import type { Metadata } from "next";
import "../globals.css";

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

  return (
    <html lang={locale}>
      <body className="antialiased">{children}</body>
    </html>
  );
}
