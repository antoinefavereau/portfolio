"use client";

import clsx from "clsx";
import { useState, useEffect } from "react";

interface SocialProps {
  socials: {
    name: string;
    url: string;
    icon: string;
  }[];
  className?: string;
}

// Composant pour charger et afficher un SVG inline
function SvgIcon({
  src,
  alt,
  className,
}: {
  src: string;
  alt: string;
  className?: string;
}) {
  const [svgContent, setSvgContent] = useState<string>("");

  useEffect(() => {
    fetch(src)
      .then((response) => response.text())
      .then((svg) => setSvgContent(svg))
      .catch((error) => console.error("Error loading SVG:", error));
  }, [src]);

  if (!svgContent) {
    return <div className="w-16 h-16 bg-gray-300 rounded animate-pulse" />;
  }

  return (
    <div
      className={className}
      dangerouslySetInnerHTML={{ __html: svgContent }}
    />
  );
}

export default function Socials({
  socials,
  className,
  ...props
}: SocialProps & React.HTMLAttributes<HTMLUListElement>) {
  return (
    <ul
      className={clsx("flex justify-center items-center gap-8", className)}
      {...props}
    >
      {socials.map((social) => (
        <li key={social.name}>
          <a
            className="text-current"
            href={social.url}
            target="_blank"
            rel="noopener noreferrer"
            title={social.name}
          >
            <SvgIcon
              src={`/socials/${social.icon}`}
              alt={social.name}
              className="w-16 h-16 [&>svg]:w-full [&>svg]:h-full [&>svg]:stroke-current"
            />
          </a>
        </li>
      ))}
    </ul>
  );
}
