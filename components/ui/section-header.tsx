export default function SectionHeader({
  title,
  subtitle,
}: {
  title: string;
  subtitle: string;
}) {
  return (
    <div className="max-w-xl flex flex-col items-center gap-4 text-center">
      <h2 className="text-primary text-2xl font-medium uppercase">{title}</h2>
      <p className="text-4xl font-medium">{subtitle}</p>
    </div>
  );
}
