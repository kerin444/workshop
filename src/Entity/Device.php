<?php

namespace App\Entity;

use App\Repository\DeviceRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeviceRepository::class)]
class Device
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $brand;

    #[ORM\Column(type: 'string', length: 255)]
    private $serialNumber;

    #[ORM\Column(type: 'datetime')]
    private $dateAdded;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateBuy;

    #[ORM\Column(type: 'text', nullable: true)]
    private $problem;

    #[ORM\Column(type: 'text', nullable: true)]
    private $diagnosis;

    #[ORM\Column(type: 'text', nullable: true)]
    private $solution;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quoteNumber;

    #[ORM\Column(type: 'date', nullable: true)]
    private $quoteDate;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quoteAmount;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'devices')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $repairDelay;

    #[ORM\Column(type: 'date', nullable: true)]
    private $repairDate;

    #[ORM\Column(type: 'date', nullable: true)]
    private $returnDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $clientFeedback;

    #[ORM\Column(type: 'date', nullable: true)]
    private $clientFeedbackDate;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'devices')]
    #[ORM\JoinColumn(nullable: false)]
    private $createdBy;

    public function __construct()
    {
        $this->dateAdded = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getDateBuy(): ?\DateTimeInterface
    {
        return $this->dateBuy;
    }

    public function setDateBuy(?\DateTimeInterface $dateBuy): self
    {
        $this->dateBuy = $dateBuy;

        return $this;
    }

    public function getProblem(): ?string
    {
        return $this->problem;
    }

    public function setProblem(?string $problem): self
    {
        $this->problem = $problem;

        return $this;
    }

    public function getDiagnosis(): ?string
    {
        return $this->diagnosis;
    }

    public function setDiagnosis(?string $diagnosis): self
    {
        $this->diagnosis = $diagnosis;

        return $this;
    }

    public function getSolution(): ?string
    {
        return $this->solution;
    }

    public function setSolution(?string $solution): self
    {
        $this->solution = $solution;

        return $this;
    }

    public function getQuoteNumber(): ?int
    {
        return $this->quoteNumber;
    }

    public function setQuoteNumber(?int $quoteNumber): self
    {
        $this->quoteNumber = $quoteNumber;

        return $this;
    }

    public function getQuoteDate(): ?\DateTimeInterface
    {
        return $this->quoteDate;
    }

    public function setQuoteDate(?\DateTimeInterface $quoteDate): self
    {
        $this->quoteDate = $quoteDate;

        return $this;
    }

    public function getQuoteAmount(): ?int
    {
        return $this->quoteAmount;
    }

    public function setQuoteAmount(?int $quoteAmount): self
    {
        $this->quoteAmount = $quoteAmount;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getRepairDelay(): ?int
    {
        return $this->repairDelay;
    }

    public function setRepairDelay(?int $repairDelay): self
    {
        $this->repairDelay = $repairDelay;

        return $this;
    }

    public function getRepairDate(): ?\DateTimeInterface
    {
        return $this->repairDate;
    }

    public function setRepairDate(?\DateTimeInterface $repairDate): self
    {
        $this->repairDate = $repairDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(?\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function getClientFeedback(): ?string
    {
        return $this->clientFeedback;
    }

    public function setClientFeedback(?string $clientFeedback): self
    {
        $this->clientFeedback = $clientFeedback;

        return $this;
    }

    public function getClientFeedbackDate(): ?\DateTimeInterface
    {
        return $this->clientFeedbackDate;
    }

    public function setClientFeedbackDate(?\DateTimeInterface $clientFeedbackDate): self
    {
        $this->clientFeedbackDate = $clientFeedbackDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
