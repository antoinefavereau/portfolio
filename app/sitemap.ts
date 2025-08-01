import { MetadataRoute } from 'next'

export default function sitemap(): MetadataRoute.Sitemap {
  const baseUrl = 'https://antoinefavereau.fr'
  const locales = ['en', 'fr']
  
  // Routes principales pour chaque locale
  const routes = [
    '',        // Page d'accueil
    // Ajoutez ici d'autres routes si vous en avez (ex: '/about', '/contact', etc.)
  ]

  const sitemapEntries: MetadataRoute.Sitemap = []

  // Ajouter la route racine (redirection vers locale par défaut)
  sitemapEntries.push({
    url: baseUrl,
    lastModified: new Date(),
    changeFrequency: 'monthly',
    priority: 1,
  })

  // Générer les entrées pour chaque locale et route
  locales.forEach((locale) => {
    routes.forEach((route) => {
      const url = route === '' 
        ? `${baseUrl}/${locale}` 
        : `${baseUrl}/${locale}${route}`
      
      sitemapEntries.push({
        url,
        lastModified: new Date(),
        changeFrequency: 'monthly',
        priority: locale === 'fr' ? 0.9 : 0.8, // Priorité légèrement plus élevée pour le français
      })
    })
  })

  return sitemapEntries
}
