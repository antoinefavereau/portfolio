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
    url?: string;
  }[];
}

export default function Projects({ texts, projects }: ProjectsProps) {
  return (
    <section
      id="projects"
      className="bg-white text-black flex flex-col justify-center items-center gap-24 py-16 pb-32"
    >
      <SectionHeader
        className="px-8 md:px-16"
        title={texts.title}
        subtitle={texts.subtitle}
      />
      <div className="grid w-full">
        {projects.map((item, index) => (
          <div className="group grid px-8 md:px-24 lg:px-32" key={index}>
            <div className="grid lg:grid-cols-[auto_1fr_1fr] gap-8 border-t-1 group-last:border-b-1 border-foreground py-8 md:py-16">
              <span className="max-lg:hidden">
                {String(index + 1).padStart(2, "0")}
              </span>
              <div className="relative max-lg:hidden">
                <Image
                  className="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 w-full h-auto aspect-square scale-0 group-hover:scale-100 transition-all duration-300 object-contain object-center"
                  src={"/projects/" + item.image}
                  alt={item.title}
                  width={500}
                  height={300}
                />
              </div>
              <div className="flex flex-col items-start gap-4">
                <a
                  className="hover:underline"
                  href={item.url}
                  target="_blank"
                  rel="noopener noreferrer"
                >
                  <h3 className="text-4xl font-bold uppercase">
                    {item.title}
                    <span className="inline-block h-[6px] w-6 bg-primary ml-2"></span>
                  </h3>
                </a>
                <Image
                  className="lg:hidden w-full h-auto rounded"
                  src={"/projects/" + item.image}
                  alt={item.title}
                  width={500}
                  height={300}
                />
                <p className="whitespace-pre-line">{item.description}</p>
              </div>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}
