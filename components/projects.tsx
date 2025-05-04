import SectionHeader from "./ui/section-header";
import Image from "next/image";

interface ProjectsProps {
  texts: {
    title: string;
    subtitle: string;
  };
  projects: {
    title: string;
    description: string;
    image: string;
    link?: string;
  }[];
}

export default function Projects({ texts, projects }: ProjectsProps) {
  return (
    <section className="bg-white text-black flex flex-col justify-center items-center gap-24 py-16 px-8 md:px-16">
      <SectionHeader title={texts.title} subtitle={texts.subtitle} />
      <div className="flex flex-col w-full px-16">
        {projects.map((item, index) => (
          <div
            key={index}
            className="group w-full grid grid-cols-[auto_1fr_1fr] gap-4 border-b-2 border-black py-8"
          >
            <span>{String(index + 1).padStart(2, "0")}</span>
            <div className="relative">
                <Image
                  className="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 w-full h-auto aspect-square scale-0 group-hover:scale-100 transition-all duration-300 object-contain object-center"
                  src={"/projects/" + item.image}
                  alt={item.title}
                  width={500}
                  height={300}
                />
            </div>
            <div className="flex flex-col gap-4">
              <h3 className="text-4xl font-bold uppercase">
                {item.title}
                <span className="inline-block h-[6px] w-6 bg-primary ml-2"></span>
              </h3>
              <p className="">{item.description}</p>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}
