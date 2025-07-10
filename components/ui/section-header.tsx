import clsx from "clsx";

export default function SectionHeader({
  title,
  subtitle,
  className,
  ...props
}: {
  title: string;
  subtitle: string;
  className?: string;
} & React.HTMLAttributes<HTMLDivElement>) {
  return (
    <div
      className={clsx(
        "max-w-xl flex flex-col items-center gap-4 text-center",
        className
      )}
      {...props}
    >
      <h2 className="text-primary text-2xl font-medium uppercase">{title}</h2>
      <p className="text-4xl font-medium">{subtitle}</p>
    </div>
  );
}
