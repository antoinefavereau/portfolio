import { MetadataRoute } from "next";

export default function manifest(): MetadataRoute.Manifest {
  return {
    name: "Antoine Favereau - Portfolio",
    short_name: "AF Portfolio",
    description:
      "Portfolio de Antoine Favereau, développeur Full Stack spécialisé en React, Next.js et Node.js",
    start_url: "/",
    display: "standalone",
    background_color: "#222831",
    theme_color: "#00adb5",
    icons: [
      {
        src: "/favicon.ico",
        sizes: "any",
        type: "image/x-icon",
      },
    ],
  };
}
