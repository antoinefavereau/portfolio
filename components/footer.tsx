import Image from "next/image";
import Socials from "./socials";

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
    };
  };
  socials: {
    name: string;
    url: string;
    icon: string;
  }[];
}

export default function Footer({ texts, socials }: FooterProps) {
  return (
    <footer id="contact" className="grid gap-24 pt-24 pb-16 px-16 md:px-32">
      <div className="grid lg:grid-cols-[1fr_450px] gap-16">
        <div className="flex flex-col gap-10 text-background">
          <h2 className="text-6xl md:text-7xl font-bold text-primary">{texts.title}</h2>
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
        <form className="grid grid-cols-2 gap-4" action="">
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
            className="col-span-2 bg-primary text-white text-xl font-semibold rounded-xl py-4 px-8 cursor-pointer hover:bg-primary-dark hover:text-light transition-colors duration-200"
            type="submit"
          >
            {texts.form.submit}
          </button>
        </form>
      </div>
      <Socials className="text-white" socials={socials} />
    </footer>
  );
}
