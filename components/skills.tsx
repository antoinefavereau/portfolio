import SectionHeader from "./ui/section-header";
import Image from "next/image";

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
              <Image
                className="w-16 h-16 object-contain rounded-full"
                src={"/skills/" + skill.image}
                alt={skill.title}
                width={64}
                height={64}
              />
              <a
                className="text-2xl font-bold text-primary hover:underline"
                href={skill.link}
                target="_blank"
                rel="noopener noreferrer"
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
