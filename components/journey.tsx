import SectionHeader from "./ui/section-header";

interface JourneyProps {
  texts: {
    title: string;
    subtitle: string;
  };
  journey: {
    title: string;
    dates: string;
    description: string;
  }[];
}

export default function Journey({ texts, journey }: JourneyProps) {
  return (
    <section className="bg-white text-black flex flex-col justify-center items-center gap-24 py-16 px-8 md:px-16">
      <SectionHeader title={texts.title} subtitle={texts.subtitle} />
      <div className="grid gap-2 w-full max-w-6xl">
        {journey.map((item, index) => (
          <div key={index} className="group flex gap-[5%]">
            <div className="w-1/4 flex-col items-end gap-2 shrink-0 hidden md:flex -mt-3">
              <h3 className="text-3xl font-bold text-end">{item.title}</h3>
              <p className="text-lg">{item.dates}</p>
            </div>
            <div className="flex flex-col items-center gap-2">
              <span className="w-5 h-5 rounded-full bg-primary"></span>
              <span className="w-1 grow bg-primary group-last:hidden"></span>
            </div>
            <div className="flex flex-col gap-2 -mt-2">
              <div className="flex flex-col gap-2 md:hidden">
                <h3 className="text-2xl font-bold">{item.title}</h3>
                <p className="text-lg">{item.dates}</p>
              </div>
              <p className="mb-8 md:mb-16 group-last:mb-0">
                {item.description}
              </p>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}
