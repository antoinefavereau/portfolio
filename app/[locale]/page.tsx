import Footer from "@/components/footer";
import Header from "@/components/header";
import Hero from "@/components/hero";
import Journey from "@/components/journey";
import Projects from "@/components/projects";
import Skills from "@/components/skills";

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
  const { default: skills } = await import(`@/data/skills.json`);
  const { default: projects } = await import(`@/data/${locale}/projects.json`);

  return (
    <>
      <Header />
      <main>
        <Hero texts={texts.hero_section} />
        <Journey texts={texts.journey_section} journey={journey} />
        <Skills texts={texts.skills_section} skills={skills} />
        <Projects texts={texts.projects_section} projects={projects} />
      </main>
      <Footer texts={texts.footer_section} />
    </>
  );
}
