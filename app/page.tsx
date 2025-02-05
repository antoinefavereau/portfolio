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
  const locale = headersData.get("x-nextjs-locale") || "en";

  try {
    const projectsModule = await import(`../data/${locale}/projects.json`);
    const textsModule = await import(`../data/${locale}/texts.json`);

    const projects: Project[] = projectsModule.default;
    const texts: Texts = textsModule.default;

    return (
      <main>
        <section className="bg-black text-white min-h-screen flex flex-col justify-center items-center text-center p-2">
          <h1>Antoine Favereau</h1>
          <p>{texts.hero_section.about}</p>
          <Button type="button">{texts.hero_section.cta}</Button>
        </section>
        <section>
          <h2>Projects</h2>
          <ul>
            {projects.map((project) => (
              <li key={project.title}>
                <h3>{project.title}</h3>
                <p>{project.description}</p>
                <img src={project.image} alt={project.title} />
                <a href={project.link}>Link</a>
              </li>
            ))}
          </ul>
        </section>
      </main>
    );
  } catch (error) {
    console.error(error);
    return notFound();
  }
}
