import { CommonModule } from '@angular/common';
import { HttpClient } from '@angular/common/http';
import { Component, inject } from '@angular/core';
import { FormsModule } from '@angular/forms';

type CensusRecord = {
  _id: string;
  householdSize: number;
  address: {
    street: string;
    city: string;
    state: string;
    zipCode: string;
  };
  year: number;
  censusTakerName: string;
};

type CensusForm = {
  householdSize: number;
  address: {
    street: string;
    city: string;
    state: string;
    zipCode: string;
  };
  year: number;
  censusTakerName: string;
};

@Component({
  selector: 'app-root',
  imports: [CommonModule, FormsModule],
  templateUrl: './app.html',
  styleUrl: './app.css'
})
export class App {
  private readonly http = inject(HttpClient);
  readonly apiUrl = 'http://localhost:3000/api/census';
  records: CensusRecord[] = [];
  form = this.createEmptyForm();
  editingId: string | null = null;
  isLoading = false;
  isSaving = false;
  errorMessage = '';

  constructor() {
    this.loadRecords();
  }

  loadRecords(): void {
    this.isLoading = true;
    this.errorMessage = '';

    this.http.get<CensusRecord[]>(this.apiUrl).subscribe({
      next: (records) => {
        this.records = records;
        this.isLoading = false;
      },
      error: (error) => {
        this.errorMessage = error.error?.message || 'Unable to load census records.';
        this.isLoading = false;
      }
    });
  }

  saveRecord(): void {
    this.isSaving = true;
    this.errorMessage = '';

    const request = this.editingId
      ? this.http.put<CensusRecord>(`${this.apiUrl}/${this.editingId}`, this.form)
      : this.http.post<CensusRecord>(this.apiUrl, this.form);

    request.subscribe({
      next: () => {
        this.resetForm();
        this.loadRecords();
        this.isSaving = false;
      },
      error: (error) => {
        this.errorMessage = error.error?.message || 'Unable to save census record.';
        this.isSaving = false;
      }
    });
  }

  editRecord(record: CensusRecord): void {
    this.editingId = record._id;
    this.form = {
      householdSize: record.householdSize,
      address: {
        street: record.address.street,
        city: record.address.city,
        state: record.address.state,
        zipCode: record.address.zipCode
      },
      year: record.year,
      censusTakerName: record.censusTakerName
    };
  }

  deleteRecord(id: string): void {
    this.errorMessage = '';

    this.http.delete(`${this.apiUrl}/${id}`).subscribe({
      next: () => {
        if (this.editingId === id) {
          this.resetForm();
        }

        this.loadRecords();
      },
      error: (error) => {
        this.errorMessage = error.error?.message || 'Unable to delete census record.';
      }
    });
  }

  resetForm(): void {
    this.editingId = null;
    this.form = this.createEmptyForm();
  }

  private createEmptyForm(): CensusForm {
    return {
      householdSize: 1,
      address: {
        street: '',
        city: '',
        state: '',
        zipCode: ''
      },
      year: new Date().getFullYear(),
      censusTakerName: ''
    };
  }
}
