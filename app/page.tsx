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
        <section className="bg-black text-white min-h-screen flex flex-col justify-center items-center gap-12 text-center p-2">
          <h1 className="text-8xl font-bold text-center">Antoine<span className="text-primary">_</span> Favereau</h1>
          <p className="max-w-lg text-lg">{texts.hero_section.about}</p>
          <Button type="button">{texts.hero_section.cta}</Button>
        </section>
      </main>
    );
  } catch (error) {
    console.error(error);
    return notFound();
  }
}
