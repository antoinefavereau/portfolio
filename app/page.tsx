import { headers } from "next/headers";
import { notFound } from "next/navigation";
import Button from "./components/ui/button";

interface Project {
  title: string;
  description: string;
  image: string;
  link: string;
}

interface Texts {
  hero_section: {
    about: string;
    cta: string;
  };
}

export default async function Home() {
  const headersData = await headers();
  const locale = headersData.get("x-nextjs-locale") ?? "fr";

  try {
    const projectsModule = await import(`../data/${locale}/projects.json`);
    const textsModule = await import(`../data/${locale}/texts.json`);

    const projects: Project[] = projectsModule.default;
    const texts: Texts = textsModule.default;

    return (
      <main>
        <section className="relative bg-black text-white min-h-screen flex flex-col justify-center items-center gap-12 text-center p-2">
          <h1 className="text-8xl font-bold text-center">
            Antoine<span className="text-primary">_</span> Favereau
          </h1>
          <p className="max-w-xl text-lg">{texts.hero_section.about}</p>
          <Button type="button">{texts.hero_section.cta}</Button>
          <svg
            className="absolute bottom-0 left-0 w-full"
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
      </main>
    );
  } catch (error) {
    console.error(error);
    return notFound();
  }
}
