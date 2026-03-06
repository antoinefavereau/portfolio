"use client";

import SectionHeader from "@/components/ui/section-header";
import { useRef } from "react";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/dist/ScrollTrigger";
import { useGSAP } from "@gsap/react";

gsap.registerPlugin(ScrollTrigger);

interface JourneyProps {
  texts: {
    title: string;
    subtitle: string;
  };
  journey: {
    title: string;
    dates: string;
    description: string;
    url?: string;
  }[];
}

export default function Journey({ texts, journey }: JourneyProps) {
  const containerRef = useRef<HTMLDivElement>(null);

  useGSAP(
    () => {
      if (!containerRef.current) return;

      const circles = containerRef.current.querySelectorAll(".circle");
      const lines = containerRef.current.querySelectorAll(".line");
      const titles = containerRef.current.querySelectorAll(".title");
      const contents = containerRef.current.querySelectorAll(".content");

      titles.forEach((title) => {
        const parentGroup = title.closest(".group");
        gsap.from(title, {
          opacity: 0,
          x: 20,
          duration: 0.6,
          ease: "back.out(1.2)",
          scrollTrigger: {
            trigger: parentGroup,
            start: "top 80%",
            toggleActions: "play none none reverse",
          },
        });
      });

      contents.forEach((content) => {
        const parentGroup = content.closest(".group");
        gsap.from(content, {
          opacity: 0,
          x: -20,
          duration: 0.6,
          ease: "back.out(1.2)",
          scrollTrigger: {
            trigger: parentGroup,
            start: "top 80%",
            toggleActions: "play none none reverse",
          },
        });
      });

      circles.forEach((circle) => {
        const parentGroup = circle.closest(".group");
        gsap.from(circle, {
          opacity: 0,
          scale: 0.2,
          duration: 0.6,
          ease: "back.out(1.7)",
          scrollTrigger: {
            trigger: parentGroup,
            start: "top 80%",
            toggleActions: "play none none reverse",
          },
        });
      });

      lines.forEach((line) => {
        const parentGroup = line.closest(".group");
        gsap.from(line, {
          opacity: 0,
          height: 0,
          duration: 0.6,
          ease: "ease.inOut",
          scrollTrigger: {
            trigger: parentGroup,
            start: "center 80%",
            toggleActions: "play none none reverse",
          },
        });
      });
    },
    { scope: containerRef },
  );

  return (
    <section
      id="journey"
      className="bg-background text-foreground flex flex-col justify-center items-center gap-24 py-16 px-8 md:px-16"
    >
      <SectionHeader title={texts.title} subtitle={texts.subtitle} />
      <div ref={containerRef} className="grid gap-2 w-full max-w-6xl">
        {journey.map((item, index) => (
          <div key={index} className="group flex gap-[5%]">
            <div className="title w-1/4 flex-col items-end gap-2 shrink-0 hidden md:flex -mt-3">
              {item.url ? (
                <a href={item.url} target="_blank" rel="noopener noreferrer">
                  <h3 className="text-3xl font-bold text-end">
                    {item.title}
                    <span className="inline-block h-[5px] w-4 bg-primary ml-2"></span>
                  </h3>
                </a>
              ) : (
                <h3 className="text-3xl font-bold text-end">{item.title}</h3>
              )}
              <p className="text-lg">{item.dates}</p>
            </div>
            <div className="flex flex-col items-center gap-2">
              <span className="relative w-5 h-5 rounded-full bg-light">
                <span className="circle absolute w-full h-full rounded-full bg-primary"></span>
              </span>
              <span className="relative w-1 grow bg-light group-last:hidden">
                <span className="line absolute w-full h-full bg-primary"></span>
              </span>
            </div>
            <div className="content flex flex-col gap-2 -mt-2">
              <div className="flex flex-col gap-2 md:hidden">
                {item.url ? (
                  <a href={item.url} target="_blank" rel="noopener noreferrer">
                    <h3 className="text-2xl font-bold">
                      {item.title}
                      <span className="inline-block h-[5px] w-4 bg-primary ml-2"></span>
                    </h3>
                  </a>
                ) : (
                  <h3 className="text-2xl font-bold">{item.title}</h3>
                )}
                <p className="text-lg">{item.dates}</p>
              </div>
              <p
                className="mb-16 md:mb-24 group-last:mb-0"
                dangerouslySetInnerHTML={{ __html: item.description }}
              />
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}
