"use client";

import { useRouter } from "next/navigation";
import { useState, useCallback } from "react";
import Socials from "./socials";
import Link from "next/link";
import { useEasterEgg } from "@/hooks/useEasterEgg";
import { useEasterEggContext } from "@/contexts/EasterEggContext";

interface HeaderProps {
  texts: {
    open_menu: string;
    close_menu: string;
  };
  navLinks: {
    href: string;
    label: string;
  }[];
  socials: {
    name: string;
    url: string;
    icon: string;
  }[];
  locale: string;
}

export default function Header({
  texts,
  locale,
  navLinks,
  socials,
}: HeaderProps) {
  const router = useRouter();
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const { discoverEasterEgg } = useEasterEggContext();

  const handleLogoClick = useEasterEgg("logo-spin", {
    onTrigger: useCallback(() => {
      // D'abord faire tourner le site
      document.body.classList.add("site-spin");

      setTimeout(() => {
        document.body.classList.remove("site-spin");
        // Déclencher l'easter egg APRÈS la rotation pour voir le toast
        discoverEasterEgg("logo-spin");
      }, 4000);
    }, [locale]),
  });

  function handleLocaleChange(newLocale: string) {
    if (newLocale !== locale) {
      const currentPath = window.location.pathname;
      const newPath = currentPath.replace(`/${locale}`, `/${newLocale}`);
      router.push(newPath);
    }
  }

  function toggleMenu() {
    setIsMenuOpen(!isMenuOpen);
  }

  function closeMenu() {
    setIsMenuOpen(false);
  }

  return (
    <header className="absolute top-0 left-0 w-full z-50 flex justify-between items-center py-8 md:py-12 px-12 md:px-20 text-background">
      <Link
        className="icon easter-egg"
        href={`/${locale}`}
        title="Antoine Favereau"
        aria-label="Antoine Favereau"
        onClick={handleLogoClick}
      >
        <svg
          className="h-auto transition-colors duration-200"
          width="50"
          viewBox="0 0 100 88"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill="currentColor"
            d="M57.0532 0H42.9431L0 74.1673L7.66775 87.4438H92.3286L100.002 74.1562L57.0532 0ZM16.5794 72.9642L49.9981 15.0384L83.4169 72.9642H16.5794Z"
          ></path>
          <path
            fill="currentColor"
            d="M40.5406 69.9807C39.267 69.9807 37.1691 67.7918 38.3127 65.911L55.2078 36.7755C56.409 34.7332 58.9042 34.6738 60.0182 36.7755L66.3306 47.5344C66.618 48.0076 66.7699 48.5506 66.7699 49.1042C66.7699 49.6578 66.618 50.2008 66.3306 50.6739L55.5624 69.4256C55.3247 69.7542 54.337 69.9937 53.5535 69.9826L40.5406 69.9807Z"
          ></path>
          <path
            fill="currentColor"
            d="M73.2316 5.38783C74.0188 3.87656 76.8687 3.79302 77.6875 5.38783L84.1336 16.5033C84.3568 16.9185 84.4737 17.3825 84.4737 17.8539C84.4737 18.3254 84.3568 18.7894 84.1336 19.2046L79.6072 27.097C78.8478 28.2592 76.1223 28.1868 75.4113 27.097L68.7275 15.5546C68.3729 14.9307 68.3562 13.9505 68.7275 13.3508L73.2316 5.38783Z"
          ></path>
        </svg>
      </Link>
      <div className="flex items-center gap-8">
        <div className="text-lg text-light">
          <button
            type="button"
            className={
              "cursor-pointer " +
              (locale === "en" ? "text-background font-bold" : "")
            }
            onClick={() => handleLocaleChange("en")}
          >
            en
          </button>
          <span> | </span>
          <button
            type="button"
            className={
              "cursor-pointer " +
              (locale === "fr" ? "text-background font-bold" : "")
            }
            onClick={() => handleLocaleChange("fr")}
          >
            fr
          </button>
        </div>
        <button
          type="button"
          className={`icon relative w-10 h-10 cursor-pointer z-50 ${
            isMenuOpen ? "text-foreground" : "text-background"
          } transition-colors duration-300`}
          onClick={toggleMenu}
          aria-expanded={isMenuOpen}
          aria-controls="navigation-menu"
          aria-label={isMenuOpen ? texts.close_menu : texts.open_menu}
          title={isMenuOpen ? texts.close_menu : texts.open_menu}
        >
          <span
            className={`absolute top-1/3 -translate-y-1/2 start-0 w-full h-[3px] bg-current transition-transform duration-300 ${
              isMenuOpen ? "rotate-45 translate-y-[7px]" : ""
            }`}
          ></span>
          <span
            className={`absolute top-2/3 -translate-y-1/2 start-0 w-full h-[3px] bg-current transition-transform duration-300 ${
              isMenuOpen ? "-rotate-45 -translate-y-[7px]" : ""
            }`}
          ></span>
        </button>
      </div>

      <nav
        id="navigation-menu"
        className={`fixed top-0 right-0 h-full w-full md:w-max flex flex-col gap-8 py-12 px-16 pt-32 z-40 bg-background text-foreground transform transition-transform duration-300 ease-in-out ${
          isMenuOpen ? "translate-x-0" : "translate-x-full"
        }`}
        aria-hidden={!isMenuOpen}
      >
        <ul className="grow flex flex-col justify-center items-center gap-2 text-xl">
          {navLinks.map((link) => (
            <li key={link.href}>
              <a
                className="block p-4 text-3xl font-semibold uppercase tracking-normal hover:tracking-widest transition-all duration-300"
                href={link.href}
                onClick={closeMenu}
              >
                {link.label}
              </a>
            </li>
          ))}
        </ul>
        <Socials className="text-foreground" socials={socials} />
      </nav>

      {/* Overlay */}
      {isMenuOpen && (
        <div
          className="fixed inset-0 bg-foreground/50 z-30"
          onClick={closeMenu}
          aria-hidden="true"
        />
      )}
    </header>
  );
}
