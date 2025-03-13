import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Contacto } from '../models/contacto';

@Injectable({
  providedIn: 'root'
})
export class ContactoService {

  apiURL = environment.apiURL;
  constructor(private http: HttpClient) { }
  getContactos():Observable<Contacto[]>{
    return this.http.get<Contacto[]>(`${this.apiURL}contactos`);
  }
}
