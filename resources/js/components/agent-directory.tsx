import { router } from '@inertiajs/react';

export type PublicAgent = {
    id: number;
    name: string;
    email: string;
    phone: string | null;
    address: string | null;
    avatar_url: string | null;
    facebook: string | null;
    twitter: string | null;
    linkedin: string | null;
    instagram: string | null;
};

function initialsFromName(name: string): string {
    const parts = name.trim().split(/\s+/).filter(Boolean);
    if (parts.length === 0) {
        return '?';
    }
    if (parts.length === 1) {
        return parts[0].slice(0, 2).toUpperCase();
    }

    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
}

function socialBtnClass(): string {
    return 'inline-flex size-9 items-center justify-center rounded-full bg-white/18 text-white transition-colors hover:bg-white/28 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white/80';
}

export function AgentDirectoryGrid({ agents }: { agents: PublicAgent[] }) {
    return (
        <ul className="mx-auto grid max-w-[1400px] grid-cols-1 gap-5 px-1 sm:gap-8 sm:px-0 md:grid-cols-2 lg:grid-cols-4">
            {agents.map((agent) => (
                <li
                    key={agent.id}
                    tabIndex={0}
                    aria-label={`${agent.name}. Tap or hover to flip for contact details. Use View listings to open properties.`}
                    className="group relative h-[300px] cursor-pointer touch-manipulation list-none rounded-2xl outline-none focus-visible:ring-2 focus-visible:ring-[#5f5af0]/70 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-300 sm:h-[320px] lg:h-[340px] dark:focus-visible:ring-offset-gray-900"
                >
                    <div className="pointer-events-none absolute bottom-11 left-0 right-0 z-[4] flex justify-center px-3 sm:bottom-14 sm:px-4">
                        <span className="rounded-full bg-black/55 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-white shadow-md backdrop-blur-sm max-[380px]:max-w-[90%] max-[380px]:truncate dark:bg-black/65 sm:px-3 sm:text-[11px]">
                            <span className="sm:hidden">Tap · flip for contacts</span>
                            <span className="hidden sm:inline">Hover / tap · flip for contacts</span>
                        </span>
                    </div>

                    <div className="h-full w-full [perspective:1100px]">
                        <div className="relative h-full w-full duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] [transform-style:preserve-3d] motion-safe:transition-transform [@media(hover:hover)]:group-hover:[transform:rotateY(180deg)] group-focus-within:[transform:rotateY(180deg)]">
                            {/* Back first in DOM — front stacks above for pointer hit-testing */}
                            <div className="absolute inset-0 z-[1] flex flex-col rounded-2xl border border-white/15 bg-gradient-to-br from-[#5f5af0] via-[#534ae6] to-[#4338ca] p-4 text-white shadow-[0_16px_48px_-12px_rgba(67,56,202,0.55)] [backface-visibility:hidden] [transform:rotateY(180deg)] sm:p-5 dark:from-zinc-800 dark:via-zinc-900 dark:to-zinc-950 dark:shadow-black/50">
                                <div className="border-b border-white/20 pb-3">
                                    <p className="text-[11px] font-semibold uppercase tracking-[0.12em] text-white/75">Contact</p>
                                    <p className="mt-1 break-words text-base font-semibold leading-snug sm:text-lg">{agent.name}</p>
                                </div>

                                <div className="mt-4 flex min-h-0 flex-1 flex-col gap-3 overflow-y-auto text-sm">
                                    <div>
                                        <p className="text-[10px] font-semibold uppercase tracking-wide text-white/65">Address</p>
                                        <p className="mt-1 leading-relaxed text-white/95">
                                            {agent.address?.trim() ? agent.address : 'Address available on request'}
                                        </p>
                                    </div>
                                    {agent.phone ? (
                                        <a
                                            href={`tel:${agent.phone.replace(/\s+/g, '')}`}
                                            className="flex items-start gap-2 rounded-lg bg-white/10 px-3 py-2 transition-colors hover:bg-white/18"
                                        >
                                            <i className="fa-solid fa-phone mt-0.5 shrink-0 text-white/85" aria-hidden />
                                            <span className="break-all">{agent.phone}</span>
                                        </a>
                                    ) : (
                                        <p className="text-white/70">
                                            <i className="fa-solid fa-phone me-2 opacity-70" aria-hidden />
                                            Phone not listed
                                        </p>
                                    )}
                                    <a
                                        href={`mailto:${encodeURIComponent(agent.email)}`}
                                        className="flex items-start gap-2 rounded-lg bg-white/10 px-3 py-2 transition-colors hover:bg-white/18"
                                    >
                                        <i className="fa-solid fa-envelope mt-0.5 shrink-0 text-white/85" aria-hidden />
                                        <span className="break-all">{agent.email}</span>
                                    </a>
                                </div>

                                <div className="mt-auto flex flex-wrap gap-2 border-t border-white/15 pt-4">
                                    <span className="text-[10px] font-semibold uppercase tracking-wide text-white/65">Social</span>
                                    <div className="flex w-full flex-wrap gap-2">
                                        {agent.facebook ? (
                                            <a
                                                href={agent.facebook}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className={socialBtnClass()}
                                                aria-label={`${agent.name} on Facebook`}
                                            >
                                                <i className="fa-brands fa-facebook-f text-sm" aria-hidden />
                                            </a>
                                        ) : null}
                                        {agent.instagram ? (
                                            <a
                                                href={agent.instagram}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className={socialBtnClass()}
                                                aria-label={`${agent.name} on Instagram`}
                                            >
                                                <i className="fa-brands fa-instagram text-sm" aria-hidden />
                                            </a>
                                        ) : null}
                                        {agent.twitter ? (
                                            <a
                                                href={agent.twitter}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className={socialBtnClass()}
                                                aria-label={`${agent.name} on X`}
                                            >
                                                <i className="fa-brands fa-x-twitter text-sm" aria-hidden />
                                            </a>
                                        ) : null}
                                        {agent.linkedin ? (
                                            <a
                                                href={agent.linkedin}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className={socialBtnClass()}
                                                aria-label={`${agent.name} on LinkedIn`}
                                            >
                                                <i className="fa-brands fa-linkedin-in text-sm" aria-hidden />
                                            </a>
                                        ) : null}
                                        {!agent.facebook &&
                                        !agent.instagram &&
                                        !agent.twitter &&
                                        !agent.linkedin ? (
                                            <span className="text-xs text-white/60">No links added yet</span>
                                        ) : null}
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    className="pointer-events-auto mt-3 min-h-11 w-full shrink-0 touch-manipulation rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-[#4338ca] shadow-md transition-colors hover:bg-white/95 dark:text-zinc-900"
                                    onClick={(e) => {
                                        e.stopPropagation();
                                        router.visit(`/properties?agent=${agent.id}`);
                                    }}
                                >
                                    View property listings
                                </button>
                            </div>

                            {/* Front */}
                            <div className="absolute inset-0 z-[2] flex flex-col overflow-hidden rounded-2xl border border-black/[0.08] bg-white shadow-[0_12px_40px_-12px_rgba(15,23,42,0.25)] [backface-visibility:hidden] dark:border-white/12 dark:bg-zinc-900 dark:shadow-black/40">
                                <div className="relative min-h-0 flex-1 bg-gradient-to-br from-[#5f5af0]/12 via-zinc-100 to-white dark:from-[#5f5af0]/20 dark:via-zinc-800 dark:to-zinc-900">
                                    {agent.avatar_url ? (
                                        <img
                                            src={agent.avatar_url}
                                            alt=""
                                            className="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.03]"
                                        />
                                    ) : (
                                        <div className="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-[#5f5af0] to-[#4338ca]">
                                            <span className="text-5xl font-bold tracking-tight text-white/95 drop-shadow-md">
                                                {initialsFromName(agent.name)}
                                            </span>
                                        </div>
                                    )}
                                    <div className="pointer-events-none absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/55 to-transparent dark:from-black/70" />
                                </div>
                                <div className="relative shrink-0 bg-white px-3 py-3 text-center dark:bg-zinc-950 sm:px-4 sm:py-4">
                                    <p className="break-words text-base font-semibold tracking-tight text-zinc-900 sm:text-lg dark:text-white">
                                        {agent.name}
                                    </p>
                                    <p className="text-muted-foreground mt-1 text-xs font-medium uppercase tracking-[0.14em]">
                                        Real estate agent
                                    </p>
                                    <button
                                        type="button"
                                        className="text-primary hover:text-primary/85 mt-3 min-h-10 w-full max-w-[14rem] touch-manipulation text-xs font-semibold underline-offset-4 hover:underline sm:mt-2 sm:inline-block sm:w-auto sm:max-w-none sm:text-sm"
                                        onClick={(e) => {
                                            e.stopPropagation();
                                            router.visit(`/properties?agent=${agent.id}`);
                                        }}
                                    >
                                        View listings →
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            ))}
        </ul>
    );
}
