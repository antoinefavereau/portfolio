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
    <section className="bg-white text-black flex flex-col justify-center items-center gap-12 text-center py-16 px-2">
      <div className="max-w-2xl flex flex-col items-center gap-4">
        <h2 className="text-primary text-2xl font-medium uppercase">
          {texts.title}
        </h2>
        <p className="text-4xl font-medium">{texts.subtitle}</p>
      </div>
      <div className="flex flex-col">
        {journey.map((item, index) => (
          <div key={index} className="flex">
            <div className="flex flex-col items-end gap-2">
              <h3 className="text-2xl font-bold">{item.title}</h3>
              <p className="text-lg">{item.dates}</p>
            </div>
            <p>{item.description}</p>
          </div>
        ))}
      </div>
    </section>
  );
}
