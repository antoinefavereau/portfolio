import { headers } from "next/headers";
import { notFound } from "next/navigation";
import Button from "./components/ui/button";

interface Texts {
  hero_section: {
    about: string;
    cta: string;
  };
  journey_section: {
    title: string;
    subtitle: string;
  };
}

interface Journey {
  title: string;
  dates: string;
  description: string;
}

interface Project {
  title: string;
  description: string;
  image: string;
  link: string;
}

export default async function Home() {
  const headersData = await headers();
  const locale = headersData.get("x-nextjs-locale") ?? "fr";

  try {
    const textsModule = await import(`../data/${locale}/texts.json`);
    const journeyModule = await import(`../data/${locale}/journey.json`);

    const texts: Texts = textsModule.default;
    const journey: Journey[] = journeyModule.default;

    return (
      <main>
        <section className="relative bg-black text-white min-h-screen flex flex-col justify-center items-center gap-12 text-center">
          <h1 className="text-8xl font-bold text-center">
            Antoine<span className="text-primary">_</span> Favereau
          </h1>
          <p className="max-w-2xl text-lg">{texts.hero_section.about}</p>
          <Button type="button">{texts.hero_section.cta}</Button>
          <svg
            className="absolute bottom-0 left-0 w-full h-auto"
            width="1920"
            height="100"
            viewBox="0 0 1920 100"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M0 0.000183105C960 100 960 100 1920 0.000183105V100H0V0.000183105Z"
              fill="var(--color-background)"
            />
            <path
              d="M-2 23C963 113.5 966.5 114.5 1921 24.5"
              stroke="var(--color-foreground)"
              strokeOpacity="0.3"
              strokeWidth="4"
            />
          </svg>
        </section>
        <section className="bg-white text-black flex flex-col justify-center items-center gap-12 text-center py-16 px-2">
          <div className="max-w-2xl flex flex-col items-center gap-4">
            <h2 className="text-primary text-2xl font-bold uppercase">
              {texts.journey_section.title}
            </h2>
            <p className="text-4xl font-medium">{texts.journey_section.subtitle}</p>
          </div>
        </section>
      </main>
    );
  } catch (error) {
    console.error(error);
    return notFound();
  }
}
