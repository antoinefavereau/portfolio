"use client";

import SectionHeader from "./ui/section-header";
import Image from "next/image";
import { useRef, useState, useCallback, useEffect } from "react";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/dist/ScrollTrigger";
import { useGSAP } from "@gsap/react";
import { useEasterEggContext } from "@/contexts/EasterEggContext";

gsap.registerPlugin(ScrollTrigger);

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
  const skillsRef = useRef<HTMLUListElement>(null);
  const [, setHoveredSkills] = useState<Set<number>>(new Set());
  const [triggerEasterEgg, setTriggerEasterEgg] = useState(false);

  const { discoverEasterEgg } = useEasterEggContext();

  // Effet pour déclencher l'easter egg
  useEffect(() => {
    if (triggerEasterEgg) {
      discoverEasterEgg("skill-master");
      setTriggerEasterEgg(false);
      setHoveredSkills(new Set());
    }
  }, [triggerEasterEgg, discoverEasterEgg]);

  // Fonction pour gérer le hover de toutes les compétences
  const handleSkillHover = useCallback(
    (skillIndex: number) => {
      setHoveredSkills((prev) => {
        const newSet = new Set(prev);
        newSet.add(skillIndex);

        // Vérifier si toutes les compétences ont été survolées
        if (newSet.size === skills.length) {
          setTriggerEasterEgg(true);
        }

        return newSet;
      });
    },
    [skills.length]
  );

  useGSAP(
    () => {
      if (!skillsRef.current) return;

      const skillItems = skillsRef.current.querySelectorAll("li");

      gsap.from(skillItems, {
        opacity: 0,
        y: 50,
        scale: 0.8,
        duration: 0.6,
        stagger: 0.1,
        ease: "back.out(1.7)",
        scrollTrigger: {
          trigger: skillsRef.current,
          start: "top 80%",
          toggleActions: "play none none reverse",
        },
      });
    },
    { scope: skillsRef }
  );

  return (
    <section id="skills" className="relative grid py-16 md:px-8">
      <div className="absolute -z-1 inset-0 bg-background"></div>
      <div className="relative flex flex-col items-center gap-24 text-background py-16 px-8 md:rounded-[3rem] overflow-hidden">
        <div className="absolute -z-1 inset-0 bg-foreground"></div>
        <SectionHeader title={texts.title} subtitle={texts.subtitle} />
        <div className="@container w-full max-w-5xl transform-3d perspective-distant">
          <ul
            ref={skillsRef}
            className="flex flex-wrap @max-sm:[&>li:nth-child(5n-4)]:ml-[16.25%] @sm:@max-xl:[&>li:nth-child(7n-6)]:ml-[12.5%] @xl:[&>li:nth-child(9n-8)]:ml-[10%] rotate-x-30 -translate-y-1/8 px-8 md:px-16 pb-8"
          >
            {skills.map((skill, index) => (
              <li
                key={index}
                className="w-1/3 @sm:w-1/4 @xl:w-1/5 h-[-webkit-fill-available] p-1 aspect-[5/4]"
              >
                <a
                  className="group relative block w-full aspect-square hover:scale-95 duration-200 ease-in-out"
                  style={{
                    clipPath:
                      "polygon(0% 25%, 0% 75%, 50% 100%, 100% 75%, 100% 25%, 50% 0%)",
                  }}
                  href={skill.link}
                  target="_blank"
                  rel="noopener noreferrer"
                  onMouseEnter={() => handleSkillHover(index)}
                >
                  <div className="absolute inset-0 grid place-content-center -z-10 group-hover:z-10 bg-primary text-xl">
                    {skill.title}
                  </div>
                  <div className="h-full bg-background">
                    <Image
                      className="relative w-full h-full object-contain object-center p-[20%]"
                      src={`/skills/${skill.image}`}
                      alt={skill.title}
                      width={64}
                      height={64}
                    />
                  </div>
                </a>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </section>
  );
}
