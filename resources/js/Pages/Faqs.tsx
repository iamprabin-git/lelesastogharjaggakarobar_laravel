import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion';
import { SiteLayout } from '@/layouts/site-layout';

type Faq = { id: number; question: string; answer: string };

export default function Faqs({ faqs }: { faqs: Faq[] }) {
    return (
        <SiteLayout title="FAQs">
            <section className="container mx-auto max-w-3xl px-4 py-16">
                <h1 className="mb-10 text-center text-3xl font-bold tracking-tight">Frequently asked questions</h1>
                {faqs.length === 0 && <p className="text-muted-foreground text-center">No FAQs published yet.</p>}
                {faqs.length > 0 && (
                    <Accordion type="single" collapsible className="space-y-3">
                        {faqs.map((f) => (
                            <AccordionItem
                                key={f.id}
                                value={`faq-${f.id}`}
                                className="bg-card rounded-xl border px-4 shadow-sm last:border-b"
                            >
                                <AccordionTrigger className="px-0 hover:no-underline">{f.question}</AccordionTrigger>
                                <AccordionContent className="px-0 pb-4 whitespace-pre-wrap">{f.answer}</AccordionContent>
                            </AccordionItem>
                        ))}
                    </Accordion>
                )}
            </section>
        </SiteLayout>
    );
}
