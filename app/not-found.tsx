import Link from "next/link";

export default function NotFound() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-foreground px-4">
      <div className="text-center">
        <h1 className="text-6xl font-bold text-background mb-4">404</h1>
        <h2 className="text-2xl font-semibold text-light mb-4">
          Page non trouvée
        </h2>
        <p className="text-light mb-8 max-w-md mx-auto">
          Désolé, la page que vous recherchez n&apos;existe pas ou a été
          déplacée.
        </p>
        <div className="space-x-4">
          <Link
            href="/fr"
            className="inline-block bg-primary text-foreground px-6 py-3 rounded-lg hover:bg-primary-dark transition-colors font-semibold"
          >
            Retour à l&apos;accueil
          </Link>
          <Link
            href="/en"
            className="inline-block border border-light text-light px-6 py-3 rounded-lg hover:bg-dark transition-colors"
          >
            Go to Homepage (EN)
          </Link>
        </div>
      </div>
    </div>
  );
}
