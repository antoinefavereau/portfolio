interface ButtonProps {
  children: React.ReactNode;
}

export default function Button({
  children,
  ...props
}: ButtonProps & React.ButtonHTMLAttributes<HTMLButtonElement>) {
  return (
    <button
      className={`group relative py-3 px-12 text-xl font-semibold cursor-pointer -skew-x-24 bg-primary rounded-sm hover:-skew-x-20 hover:rounded-md transition duration-200 ease-in-out ${props.className}`}
      {...props}
    >
      <div
        className="absolute inset-0 bg-linear-to-r from-[#fff3] to-[#fff3] group-hover:animate-[buttonHover_0.4s_ease-in-out]"
        style={{
          backgroundSize: "0% 100%",
          backgroundPositionX: "0%",
          backgroundPositionY: "0%",
          backgroundRepeat: "no-repeat",
        }}
      ></div>
      <div className="relative skew-x-24 group-hover:skew-x-20 transition duration-200 ease-in-out">
        {children}
      </div>
    </button>
  );
}
