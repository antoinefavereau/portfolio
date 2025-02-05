interface ButtonProps {
    children: React.ReactNode;
}

export default function Button({ children, ...props }: ButtonProps & React.ButtonHTMLAttributes<HTMLButtonElement>) {
    return (
        <button className={`relative py-3 px-12 text-xl font-semibold ${props.className}`} {...props}>
            <div className="absolute inset-0 -skew-x-12 bg-primary"></div>
            <div className="relative">
                {children}
            </div>
            <div></div>
        </button>
    );
}