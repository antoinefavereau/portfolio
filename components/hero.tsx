"use client";

import { useEffect, useMemo, useRef } from "react";
import { gsap } from "gsap";
import { useGSAP } from "@gsap/react";
import { ScrollTrigger } from "gsap/dist/ScrollTrigger";
import Button from "./ui/button";
import Particles, { initParticlesEngine } from "@tsparticles/react";
import {
  type ISourceOptions,
  MoveDirection,
  OutMode,
} from "@tsparticles/engine";
import { loadSlim } from "@tsparticles/slim";
import { useEasterEgg } from "@/hooks/useEasterEgg";

gsap.registerPlugin(ScrollTrigger);

interface HeroProps {
  texts: {
    about: string;
    cta: string;
  };
}

export default function Hero({ texts }: HeroProps) {
  const containerRef = useRef<HTMLDivElement>(null);
  const contentRef = useRef<HTMLDivElement>(null);
  const handleEasterEggClick = useEasterEgg("name-spin");

  useEffect(() => {
    initParticlesEngine(async (engine) => {
      await loadSlim(engine);
    });
  }, []);

  useGSAP(
    () => {
      gsap.to(contentRef.current, {
        y: 200,
        opacity: 0,
        scrollTrigger: {
          trigger: containerRef.current,
          scroller: document.body,
          start: "top top",
          end: "bottom top",
          scrub: true,
        },
      });
    },
    { scope: containerRef }
  );

  const options: ISourceOptions = useMemo(
    () => ({
      fpsLimit: 120,
      interactivity: {
        events: {
          onHover: {
            enable: true,
            mode: "repulse",
          },
        },
        modes: {
          repulse: {
            distance: 100,
            duration: 1,
          },
        },
      },
      particles: {
        color: {
          value: "#00adb5",
        },
        links: {
          color: "#00adb5",
          distance: 150,
          enable: true,
          opacity: 0.5,
          width: 1,
        },
        move: {
          direction: MoveDirection.none,
          enable: true,
          outModes: {
            default: OutMode.out,
          },
          random: false,
          speed: 2,
          straight: false,
        },
        number: {
          density: {
            enable: true,
          },
          value: 80,
        },
        opacity: {
          value: 0.5,
        },
        shape: {
          type: "circle",
        },
        size: {
          value: { min: 1, max: 5 },
        },
      },
      detectRetina: true,
    }),
    []
  );

  return (
    <div
      ref={containerRef}
      className="relative min-h-screen grid content-center px-8"
    >
      <Particles
        id="tsparticles"
        options={options}
        className="absolute inset-0 -z-1"
      />
      <div
        ref={contentRef}
        className="relative flex flex-col justify-center items-center gap-8 sm:gap-12 text-center"
      >
        <h1
          className="text-6xl sm:text-8xl font-bold text-center easter-egg"
          onClick={handleEasterEggClick}
        >
          Antoine<span className="text-primary">_</span>&#8203;Favereau
        </h1>
        <p className="max-w-2xl text-md sm:text-lg">{texts.about}</p>
        <Button
          type="button"
          onClick={() => {
            window.location.href = "#journey";
          }}
        >
          {texts.cta}
        </Button>
      </div>
      <svg
        className="absolute bottom-[-1px] left-0 w-full h-auto"
        width="1920"
        height="100"
        viewBox="0 0 1920 100"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M0 0.000183105C960 100 960 100 1920 0.000183105V100H0V0.000183105Z"
          fill="var(--color-background)"
        />
        <path
          d="M-2 23C963 113.5 966.5 114.5 1921 24.5"
          stroke="var(--color-foreground)"
          strokeOpacity="0.3"
          strokeWidth="4"
        />
      </svg>
    </div>
  );
}
