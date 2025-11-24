/*******************************************************************
 * Name: Amber Lawson
 * Date: 20 November 2025
 * Purpose: BankUser demonstrates composition.
 * A BankUser "has" multiple BankAccount objects.
 ******************************************************************/

import java.util.ArrayList;

public class BankUser {
    private String name;
    private ArrayList<BankAccount> accounts = new ArrayList<>();

    public BankUser(String name) {
        this.name = name;
    }

    public String getName() {
        return name;
    }

    public void addAccount(BankAccount account) {
        accounts.add(account);
    }

    public ArrayList<BankAccount> getAccounts() {
        return accounts;
    }
}