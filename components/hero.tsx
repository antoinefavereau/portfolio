import Button from "./ui/button";

interface HeroProps {
  texts: {
    about: string;
    cta: string;
  };
}

export default function Hero({ texts }: HeroProps) {
  return (
    <section className="relative bg-black text-white min-h-screen flex flex-col justify-center items-center gap-12 text-center px-8">
      <h1 className="text-6xl sm:text-8xl font-bold text-center">
        Antoine<span className="text-primary">_</span>&#8203;Favereau
      </h1>
      <p className="max-w-2xl text-md sm:text-lg">{texts.about}</p>
      <Button type="button">{texts.cta}</Button>
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
    </section>
  );
}
