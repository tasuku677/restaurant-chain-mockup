<?php
    namespace Companies;
    use Interfaces\FileConvertible;

    class Company implements FileConvertible{
        private string $name;
        private int $foundingYear;
        private string $description;
        private string $website;
        private string $phone;
        private string $industry;
        private string $ceo;
        private bool $isPublicityTraded;
        private string $country;
        private string $founder;
        private int $totalEmployees;

        public function __construct(
            string $name, int $foundingYear, string $description,
            string $website, string $phone, string $industry,
            string $ceo, bool $isPublicityTraded, string $country,
            string $founder, int $totalEmployees
        ){
            $this->name = $name;
            $this->foundingYear = $foundingYear;
            $this->description = $description;
            $this->website = $website;
            $this->phone = $phone;
            $this->industry = $industry;
            $this->ceo = $ceo;
            $this->isPublicityTraded = $isPublicityTraded;
            $this->country = $country;
            $this->founder = $founder;
            $this->totalEmployees = $totalEmployees;
        }
        public function toString(): string {
            return sprintf(
                "Name: %s\nFounding Year: %d\nDescription: %s\nWebsite: %s\nPhone: %s\nIndustry: %s\nCEO: %s\nPublicly Traded: %s\nCountry: %s\nFounder: %s\nTotal Employees: %d\n",
                $this->name,
                $this->foundingYear,
                $this->description,
                $this->website,
                $this->phone,
                $this->industry,
                $this->ceo,
                $this->isPublicityTraded ? 'Yes' : 'No',
                $this->country,
                $this->founder,
                $this->totalEmployees
            );
        }
    
        public function toHTML(): string {
            return sprintf("
                <div class='company-card'>
                    <h2>%s</h2>
                    <p><strong>Founding Year:</strong> %d</p>
                    <p><strong>Description:</strong> %s</p>
                    <p><strong>Website:</strong> <a href='%s'>%s</a></p>
                    <p><strong>Phone:</strong> %s</p>
                    <p><strong>Industry:</strong> %s</p>
                    <p><strong>CEO:</strong> %s</p>
                    <p><strong>Publicly Traded:</strong> %s</p>
                    <p><strong>Country:</strong> %s</p>
                    <p><strong>Founder:</strong> %s</p>
                    <p><strong>Total Employees:</strong> %d</p>
                </div>",
                $this->name,
                $this->foundingYear,
                $this->description,
                $this->website, $this->website,
                $this->phone,
                $this->industry,
                $this->ceo,
                $this->isPublicityTraded ? 'Yes' : 'No',
                $this->country,
                $this->founder,
                $this->totalEmployees
            );
        }
    
        public function toMarkdown(): string {
            return sprintf(
                "## %s\n- **Founding Year:** %d\n- **Description:** %s\n- **Website:** [%s](%s)\n- **Phone:** %s\n- **Industry:** %s\n- **CEO:** %s\n- **Publicly Traded:** %s\n- **Country:** %s\n- **Founder:** %s\n- **Total Employees:** %d\n",
                $this->name,
                $this->foundingYear,
                $this->description,
                $this->website, $this->website,
                $this->phone,
                $this->industry,
                $this->ceo,
                $this->isPublicityTraded ? 'Yes' : 'No',
                $this->country,
                $this->founder,
                $this->totalEmployees
            );
        }
    
        public function toArray(): array {
            return [
                'name' => $this->name,
                'foundingYear' => $this->foundingYear,
                'description' => $this->description,
                'website' => $this->website,
                'phone' => $this->phone,
                'industry' => $this->industry,
                'ceo' => $this->ceo,
                'isPublicityTraded' => $this->isPublicityTraded,
                'country' => $this->country,
                'founder' => $this->founder,
                'totalEmployees' => $this->totalEmployees
            ];
        }


    }