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
    <section className="grid bg-background py-16 px-8">
      <div className="flex flex-col items-center gap-24 bg-foreground text-background py-16 px-8 rounded-[3rem] overflow-hidden">
        <SectionHeader title={texts.title} subtitle={texts.subtitle} />
        <div className="@container w-full max-w-5xl transform-3d perspective-distant">
          <ul className="flex flex-wrap @max-sm:[&>li:nth-child(5n-4)]:ml-[16.25%] @sm:@max-xl:[&>li:nth-child(7n-6)]:ml-[12.5%] @xl:[&>li:nth-child(9n-8)]:ml-[10%] rotate-x-30 -translate-y-1/8 px-16 pb-8">
            {skills.map((skill, index) => (
              <li
                key={index}
                className="w-1/3 @sm:w-1/4 @xl:w-1/5 h-[-webkit-fill-available] p-1 aspect-[5/4]"
              >
                <div
                  className="group relative w-full aspect-square hover:scale-95 duration-200 ease-in-out"
                  style={{
                    clipPath:
                      "polygon(0% 25%, 0% 75%, 50% 100%, 100% 75%, 100% 25%, 50% 0%)",
                  }}
                >
                  <a
                    className="absolute inset-0 grid place-content-center -z-10 group-hover:z-10 bg-primary text-xl"
                    href={skill.link}
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    {skill.title}
                  </a>
                  <div className="h-full bg-white">
                    <Image
                      className="relative w-full h-full object-contain object-center p-[20%]"
                      src={`/skills/${skill.image}`}
                      alt={skill.title}
                      width={64}
                      height={64}
                    />
                  </div>
                </div>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </section>
  );
}
