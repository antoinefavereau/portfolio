import Hero from "@/components/hero";
import Journey from "@/components/journey";

interface PageProps {
  params: Promise<{ locale: string }>;
}

export async function generateStaticParams() {
  return ["en", "fr"].map((locale) => ({ locale }));
}

export default async function Page({ params }: PageProps) {
  const { locale } = await params;

  const { default: texts } = await import(`@/data/${locale}/texts.json`);
  const { default: journey } = await import(`@/data/${locale}/journey.json`);

  return (
    <main>
      <Hero texts={texts.hero_section} />
      <Journey texts={texts.journey_section} journey={journey} />
    </main>
  );
}
