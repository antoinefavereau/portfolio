import SectionHeader from "./ui/section-header";

interface SkillsProps {
  texts: {
    title: string;
    subtitle: string;
  };
  skills: {
    title: string;
    image: string;
    link: string;
  }[];
}

export default function Skills({ texts, skills }: SkillsProps) {
  return (
    <section className="bg-background py-16 px-8">
      <div className="w-full bg-foreground text-background flex flex-col items-center gap-24 p-16 rounded-[3rem]">
        <SectionHeader title={texts.title} subtitle={texts.subtitle} />
        <ul className="flex flex-wrap gap-16">
          {skills.map((skill, index) => (
            <li key={index} className="flex gap-8 items-center">
              <img
                src={skill.image}
                alt={skill.title}
                className="w-16 h-16 rounded-full"
              />
              <a
                href={skill.link}
                target="_blank"
                rel="noopener noreferrer"
                className="text-2xl font-bold text-primary hover:underline"
              >
                {skill.title}
              </a>
            </li>
          ))}
        </ul>
      </div>
    </section>
  );
}
