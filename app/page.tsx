import { headers } from "next/headers";
import { redirect } from "next/navigation";
import Negotiator from "negotiator";
import { match } from "@formatjs/intl-localematcher";

const locales = ["en", "fr"];
const defaultLocale = "en";

export default async function RootPage() {
  const acceptLang = (await headers()).get("accept-language") || "";
  const languages = new Negotiator({
    headers: { "accept-language": acceptLang },
  }).languages();
  const locale = match(languages, locales, defaultLocale);

  redirect(`/${locale}`);
}
