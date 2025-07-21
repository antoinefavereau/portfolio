"use client";

import Image from "next/image";
import Socials from "./socials";
import { useState, useRef } from "react";

type FormData = {
  name: string;
  email: string;
  subject: string;
  message: string;
};

interface FooterProps {
  texts: {
    title: string;
    subtitle: string;
    form: {
      name: string;
      email: string;
      subject: string;
      message: string;
      submit: string;
      success: string;
      error: string;
    };
  };
  socials: {
    name: string;
    url: string;
    icon: string;
  }[];
}

export default function Footer({ texts, socials }: FooterProps) {
  const [status, setStatus] = useState<"idle" | "sending" | "sent" | "error">(
    "idle"
  );
  const formRef = useRef<HTMLFormElement>(null);

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    setStatus("sending");
    const data = {
      name: (e.currentTarget.elements.namedItem("name") as HTMLInputElement)
        .value,
      email: (e.currentTarget.elements.namedItem("email") as HTMLInputElement)
        .value,
      subject: (
        e.currentTarget.elements.namedItem("subject") as HTMLInputElement
      ).value,
      message: (
        e.currentTarget.elements.namedItem("message") as HTMLTextAreaElement
      ).value,
    } as FormData;
    const res = await fetch("/api/contact", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    });
    if (res.ok) {
      setStatus("sent");
    } else {
      setStatus("error");
    }
    if (res.ok && formRef.current) {
      formRef.current.reset();
    }
  }

  return (
    <footer
      id="contact"
      className="grid gap-24 pt-24 pb-16 px-8 sm:px-16 md:px-32"
    >
      <div className="grid lg:grid-cols-[1fr_450px] gap-16">
        <div className="flex flex-col gap-10 text-background">
          <h2 className="text-6xl md:text-7xl font-bold text-primary">
            {texts.title}
          </h2>
          <p>{texts.subtitle}</p>
          <ul className="flex flex-col items-start gap-4">
            <li>
              <a
                className="flex items-center gap-4"
                href="mailto:antoinefavereau45@gmail.com"
              >
                <Image
                  src="/contacts/Mail.svg"
                  alt="Mail"
                  width={32}
                  height={32}
                />
                <span>antoinefavereau45@gmail.com</span>
              </a>
            </li>
            <li>
              <a className="flex items-center gap-4" href="tel:+33677455362">
                <Image
                  src="/contacts/Phone.svg"
                  alt="Phone"
                  width={32}
                  height={32}
                />
                <span>+33677455362</span>
              </a>
            </li>
          </ul>
        </div>
        <form
          ref={formRef}
          className="grid grid-cols-2 gap-4 text-background"
          onSubmit={handleSubmit}
        >
          <div className="form-control">
            <input
              className="input"
              type="text"
              id="name"
              name="name"
              required
            />
            <label htmlFor="name">{texts.form.name}</label>
          </div>
          <div className="form-control">
            <input
              className="input"
              type="email"
              id="email"
              name="email"
              required
            />
            <label htmlFor="email">{texts.form.email}</label>
          </div>
          <div className="form-control col-span-2">
            <input
              className="input"
              type="text"
              id="subject"
              name="subject"
              required
            />
            <label htmlFor="subject">{texts.form.subject}</label>
          </div>
          <div className="form-control col-span-2">
            <textarea
              className="input"
              id="message"
              name="message"
              rows={4}
              required
            ></textarea>
            <label htmlFor="message">{texts.form.message}</label>
          </div>
          <button
            className="col-span-2 flex justify-center items-center gap-2 bg-primary text-white text-xl font-semibold rounded-xl py-4 px-8 cursor-pointer hover:bg-primary-dark hover:text-light transition-colors duration-200"
            type="submit"
            disabled={status === "sending"}
          >
            {status === "sending" && (
              <svg className="size-5 animate-spin" viewBox="0 0 24 24">
                <path
                  className="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2.93 6.364A8.003 8.003 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3.93-1.574z"
                ></path>
              </svg>
            )}
            {texts.form.submit}
          </button>
          {status === "sent" && <p>{texts.form.success}</p>}
          {status === "error" && <p>{texts.form.error}</p>}
        </form>
      </div>
      <Socials className="text-background" socials={socials} />
    </footer>
  );
}
