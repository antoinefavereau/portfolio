interface StructuredDataProps {
  locale: string;
}

export default function StructuredData({ locale }: StructuredDataProps) {
  const isEnglish = locale === 'en';
  
  const personSchema = {
    "@context": "https://schema.org",
    "@type": "Person",
    name: "Antoine Favereau",
    url: "https://antoinefavereau.fr",
    sameAs: [
      "https://github.com/antoinefavereau",
      "https://linkedin.com/in/antoine-favereau",
      "https://codepen.io/antoinefavereau"
    ],
    jobTitle: isEnglish ? "Full Stack Developer" : "Développeur Full Stack",
    description: isEnglish 
      ? "Full Stack Developer based in Paris, France, specializing in React, Next.js, Node.js and modern web technologies"
      : "Développeur Full Stack basé à Paris, spécialisé en React, Next.js, Node.js et technologies web modernes",
    knowsAbout: [
      "JavaScript",
      "TypeScript", 
      "React",
      "Next.js",
      "Node.js",
      "PHP",
      "MySQL",
      "MongoDB",
      "HTML",
      "CSS",
      "SASS",
      "Tailwind CSS",
      "Git",
      "WordPress",
      "Figma"
    ],
    worksFor: {
      "@type": "Organization",
      name: "Freelance"
    },
    address: {
      "@type": "PostalAddress",
      addressCountry: "FR",
      addressLocality: "Paris",
      addressRegion: "Île-de-France"
    }
  };

  return (
    <script
      type="application/ld+json"
      dangerouslySetInnerHTML={{
        __html: JSON.stringify(personSchema),
      }}
    />
  );
}
