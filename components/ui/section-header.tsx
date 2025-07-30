"use client";

import clsx from "clsx";
import { useEffect, useRef } from "react";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

interface SectionHeaderProps {
  title: string;
  subtitle: string;
  className?: string;
}

export default function SectionHeader({
  title,
  subtitle,
  className,
  ...props
}: SectionHeaderProps & React.HTMLAttributes<HTMLDivElement>) {
  const titleRef = useRef<HTMLHeadingElement>(null);

  useEffect(() => {
    if (!titleRef.current) return;

    // Fonction pour créer l'effet de scramble text
    const scrambleText = (element: HTMLElement, originalText: string) => {
      // Caractères monospace plus dynamiques
      const chars = "!@#$%^&*()_+-=[]{}|;:,.<>?/~`";

      // Animation de scramble
      gsap.to(element, {
        duration: 0.8,
        ease: "none",
        onUpdate: function () {
          const progress = this.progress();
          let scrambledText = "";

          for (let i = 0; i < originalText.length; i++) {
            if (progress * originalText.length > i) {
              scrambledText += originalText[i];
            } else {
              // Préserver les espaces
              if (originalText[i] === " ") {
                scrambledText += " ";
              } else {
                scrambledText +=
                  chars[Math.floor(Math.random() * chars.length)];
              }
            }
          }

          element.textContent = scrambledText;
        },
        onComplete: function () {
          element.textContent = originalText;
        },
      });
    };

    // Configuration du ScrollTrigger
    ScrollTrigger.create({
      trigger: titleRef.current,
      start: "top 90%", // Déclenche quand le top de l'élément atteint 90% de la hauteur de l'écran (10% du haut)
      end: "bottom 10%", // L'animation se reverse quand l'élément sort par le bas
      toggleActions: "play none none reverse", // L'animation se rejoue à chaque fois
      onEnter: () => {
        if (titleRef.current) {
          scrambleText(titleRef.current, title);
        }
      },
      onLeaveBack: () => {
        // Remet le texte à son état initial quand on remonte
        if (titleRef.current) {
          titleRef.current.textContent = title;
        }
      },
    });

    // Cleanup
    return () => {
      ScrollTrigger.getAll().forEach((trigger) => trigger.kill());
    };
  }, [title]);

  return (
    <div
      className={clsx(
        "max-w-xl flex flex-col items-center gap-4 text-center",
        className
      )}
      {...props}
    >
      <h2
        ref={titleRef}
        className="text-primary text-xl md:text-2xl font-semibold uppercase font-mono"
      >
        {title}
      </h2>
      <p className="text-3xl md:text-4xl font-medium">{subtitle}</p>
    </div>
  );
}
