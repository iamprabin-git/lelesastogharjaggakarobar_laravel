import { FaqSection } from '@/components/faq-section';
import { SiteLayout } from '@/layouts/site-layout';

type Faq = { id: number; question: string; answer: string };

export default function Faqs({ faqs }: { faqs: Faq[] }) {
    return (
        <SiteLayout title="FAQs">
            <FaqSection faqs={faqs} titleAs="h1" />
        </SiteLayout>
    );
}
