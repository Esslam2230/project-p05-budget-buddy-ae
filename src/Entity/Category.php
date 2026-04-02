<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $income_expense = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, Transaction>
     */
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Transaction::class)]
    private Collection $transacties;

    public function __construct()
    {
        $this->transacties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIncomeExpense(): ?string
    {
        return $this->income_expense;
    }

    public function setIncomeExpense(string $income_expense): static
    {
        $this->income_expense = $income_expense;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getTransacties(): Collection
    {
        return $this->transacties;
    }

    public function addTransacty(Transaction $transacty): static
    {
        if (!$this->transacties->contains($transacty)) {
            $this->transacties->add($transacty);
            $transacty->setCategory($this);
        }

        return $this;
    }

    public function removeTransacty(Transaction $transacty): static
    {
        if ($this->transacties->removeElement($transacty)) {
            // set the owning side to null (unless already changed)
            if ($transacty->getCategory() === $this) {
                $transacty->setCategory(null);
            }
        }

        return $this;
    }
}
