import { headers } from "next/headers";
import { notFound } from "next/navigation";
import Hero from "./components/Hero";
import Journey from "./components/Journey";

export default async function Home() {
  const headersData = await headers();
  const locale = headersData.get("x-nextjs-locale") ?? "fr";

  try {
    const textsModule = await import(`../data/${locale}/texts.json`);
    const journeyModule = await import(`../data/${locale}/journey.json`);

    const texts = textsModule.default;
    const journey = journeyModule.default;

    return (
      <main>
        <Hero texts={texts.hero_section} />
        <Journey texts={texts.journey_section} journey={journey} />
      </main>
    );
  } catch (error) {
    console.error(error);
    return notFound();
  }
}
