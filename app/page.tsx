import { headers } from "next/headers";
import { notFound } from "next/navigation";

interface Project {
  title: string;
  description: string;
  image: string;
  link: string;
}

interface Texts {
  hero_section: {
    about: string;
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
        <section>
          <h1>Antoine Favereau</h1>
          <p>{texts.hero_section.about}</p>
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
