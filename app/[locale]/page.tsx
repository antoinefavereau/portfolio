import Footer from "@/components/footer";
import Header from "@/components/header";
import Hero from "@/components/hero";
import Journey from "@/components/journey";
import Projects from "@/components/projects";
import Skills from "@/components/skills";
import { notFound } from "next/navigation";
import { SUPPORTED_LOCALES, type SupportedLocale } from "@/lib/constants";

interface PageProps {
  params: Promise<{ locale: string }>;
}

export async function generateStaticParams() {
  return SUPPORTED_LOCALES.map((locale) => ({ locale }));
}

export default async function Page({ params }: PageProps) {
  const { locale } = await params;

  // Validation de la locale
  if (!SUPPORTED_LOCALES.includes(locale as SupportedLocale)) {
    notFound();
  }

  // Import sécurisé avec gestion d'erreur
  let texts, navLinks, journey, projects;
  try {
    const [textsModule, navLinksModule, journeyModule, projectsModule] =
      await Promise.all([
        import(`@/data/${locale}/texts.json`),
        import(`@/data/${locale}/navLinks.json`),
        import(`@/data/${locale}/journey.json`),
        import(`@/data/${locale}/projects.json`),
      ]);

    texts = textsModule.default;
    navLinks = navLinksModule.default;
    journey = journeyModule.default;
    projects = projectsModule.default;
  } catch (error) {
    console.error(`Failed to load data for locale: ${locale}`, error);
    notFound();
  }

  const { default: skills } = await import(`@/data/skills.json`);
  const { default: socials } = await import(`@/data/socials.json`);

  return (
    <>
      <Header
        texts={texts.header}
        navLinks={navLinks}
        socials={socials}
        locale={locale}
      />
      <main>
        <Hero texts={texts.hero_section} />
        <Journey texts={texts.journey_section} journey={journey} />
        <Skills texts={texts.skills_section} skills={skills} />
        <Projects texts={texts.projects_section} projects={projects} />
      </main>
      <Footer texts={texts.footer} socials={socials} />
    </>
  );
}
