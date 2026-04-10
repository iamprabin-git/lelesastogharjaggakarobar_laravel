import { Link } from '@inertiajs/react';
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion';
import { Button } from '@/components/ui/button';
import { cn } from '@/lib/utils';

export type FaqEntry = {
    id: number;
    question: string;
    answer: string;
};

type FaqSectionProps = {
    faqs: FaqEntry[];
    title?: string;
    /** Use h1 on the dedicated /faqs page; h2 on embedded sections */
    titleAs?: 'h1' | 'h2' | 'h3';
    emptyMessage?: string;
    className?: string;
    innerClassName?: string;
    /** Show only the first N items (e.g. on home) */
    limit?: number;
    footerLink?: { href: string; label: string };
};

/**
 * Shared FAQ accordion: Supports HTML content in answers and handles
 * semantic rendering without nested paragraph conflicts.
 */
export function FaqSection({
    faqs,
    title = 'Frequently asked questions',
    titleAs: TitleTag = 'h2',
    emptyMessage = 'No FAQs published yet.',
    className,
    innerClassName,
    limit,
    footerLink,
}: FaqSectionProps) {
    const list = limit !== undefined ? faqs.slice(0, limit) : faqs;

    return (
        <section
            className={cn(
                'from-muted/30 bg-linear-to-b via-background to-background border-y border-border/60 py-16',
                className,
            )}
        >
            <div className={cn('container mx-auto max-w-3xl px-4', innerClassName)}>
                <TitleTag
                    className={cn(
                        'mb-10 text-center font-bold tracking-tight',
                        TitleTag === 'h1' ? 'text-3xl md:text-4xl' : 'text-2xl md:text-3xl',
                    )}
                >
                    {title}
                </TitleTag>

                {list.length === 0 ? (
                    <p className="text-muted-foreground text-center leading-relaxed">{emptyMessage}</p>
                ) : (
                    <>
                        <Accordion type="single" collapsible className="space-y-3">
                            {list.map((f) => (
                                <AccordionItem
                                    key={f.id}
                                    value={`faq-${f.id}`}
                                    className="border-border/80 bg-card/90 hover:border-primary/25 rounded-2xl border px-4 shadow-sm transition-colors duration-200 last:border-b"
                                >
                                    <AccordionTrigger className="text-foreground hover:text-primary px-0 py-4 text-left text-base font-semibold hover:no-underline [&[data-state=open]]:text-primary">
                                        {f.question}
                                    </AccordionTrigger>
                                    <AccordionContent className="text-muted-foreground px-0 pt-0 pb-4 text-[15px] leading-relaxed">
                                        {/* The div below renders the HTML string directly.
                                            The 'prose' classes ensure nested <p> or <ul> tags
                                            inside the answer are styled correctly.
                                        */}
                                        <div
                                            className="prose prose-sm max-w-none dark:prose-invert"
                                            dangerouslySetInnerHTML={{ __html: f.answer }}
                                        />
                                    </AccordionContent>
                                </AccordionItem>
                            ))}
                        </Accordion>

                        {footerLink ? (
                            <div className="mt-10 flex justify-center">
                                <Button variant="outline" asChild>
                                    <Link href={footerLink.href}>{footerLink.label}</Link>
                                </Button>
                            </div>
                        ) : null}
                    </>
                )}
            </div>
        </section>
    );
}
